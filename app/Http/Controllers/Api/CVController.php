<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadCVRequest;
use App\Models\AnalysisResult;
use App\Models\Career;
use App\Models\CareerMatchResult;
use App\Models\CVFile;
use App\Services\CareerMatchingService;
use App\Services\NotificationService;
use App\Services\PDFExtractorService;
use App\Services\RoadmapGeneratorService;
use App\Services\SkillDetectionService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CVController extends Controller
{
    public function upload(UploadCVRequest $request, NotificationService $notifications)
    {
        $validated = $request->validated();

        $file = $request->file('cv');

        $fileName = Str::uuid().'.'.$file->getClientOriginalExtension();

        $filePath = $file->storeAs('cv', $fileName, 'public');

        $cvFile = CVFile::create([
            'user_id' => $request->user()->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'mime_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        $notifications->send(
            'upload_cv',
            'CV baru diunggah',
            "{$request->user()->name} mengunggah CV \"{$cvFile->file_name}\".",
            ['user_id' => $request->user()->id],
        );

        return response()->json([
            'message' => 'CV berhasil diupload.',
            'data' => $cvFile,
        ], 201);
    }

    public function extract(CVFile $cvFile, PDFExtractorService $extractor)
    {
        $fullPath = Storage::disk('public')->path($cvFile->file_path);

        if (! file_exists($fullPath)) {
            return response()->json([
                'message' => 'File PDF tidak ditemukan diserver.',
            ], 404);
        }

        try {
            $text = $extractor->extract($fullPath);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        $cvFile->update([
            'extracted_text' => $text,
        ]);

        return response()->json([
            'message' => 'Teks berhasil diekstrak dari PDF.',
            'data' => $cvFile,
        ]);
    }

    public function detectSkills(CVFile $cvFile, SkillDetectionService $detector)
    {
        if (empty($cvFile->extracted_text)) {
            return response()->json([
                'message' => 'CV ini belum diekstrak. Jalankan proses extract terlebih dahulu.',
            ], 422);
        }

        $detectedSkills = $detector->detect($cvFile->extracted_text);

        $analysisResult = AnalysisResult::create([
            'user_id' => $cvFile->user_id,
            'cv_file_id' => $cvFile->id,
            'career_id' => null,
            'match_score' => 0,
            'skills_json' => $detectedSkills,
        ]);

        return response()->json([
            'message' => 'Skill berhasil dideteksi dari CV.',
            'data' => $analysisResult,
        ], 201);
    }

    public function matchCareer(AnalysisResult $analysisResult, CareerMatchingService $matcher, NotificationService $notifications)
    {
        if (empty($analysisResult->skills_json)) {
            return response()->json([
                'message' => 'Analysis result ini belum memiliki data skill. Jalankan proses detect-skills terlebih dahulu.',
            ], 422);
        }

        $allResults = $matcher->matchAll($analysisResult->skills_json);

        if (empty($allResults)) {
            return response()->json([
                'message' => 'Tidak ditemukan career yang cocok. Pastikan data career_skills sudah diisi.',
            ], 404);
        }

        $analysisResult->careerMatches()->delete();

        foreach ($allResults as $index => $result) {
            CareerMatchResult::create([
                'analysis_result_id' => $analysisResult->id,
                'career_id' => $result['career']->id,
                'match_score' => $result['match_score'],
                'matched_skills_json' => $result['matched_skills'],
                'skill_gap_json' => $result['skill_gap'],
                'is_best_match' => $index === 0,
            ]);
        }

        $best = $allResults[0];

        $analysisResult->update([
            'career_id' => $best['career']->id,
            'match_score' => $best['match_score'],
            'skill_gap_json' => $best['skill_gap'],
        ]);

        $notifications->send(
            'analisis',
            'Analisis CV selesai',
            "{$analysisResult->user->name} selesai dianalisis, skor kecocokan {$best['match_score']}% dengan karir \"{$best['career']->title}\".",
            ['analysis_result_id' => $analysisResult->id],
        );

        return response()->json([
            'message' => 'Career matching berhasil.',
            'data' => $analysisResult->fresh(['career', 'careerMatches.career']),
        ]);
    }

    public function generateRoadmap(AnalysisResult $analysisResult, Career $career, RoadmapGeneratorService $generator)
    {
        abort_if($analysisResult->user_id !== auth()->id(), 403, 'Anda tidak berhak mengakses data ini.');

        $careerMatch = $analysisResult->careerMatches()
            ->where('career_id', $career->id)
            ->first();

        if (! $careerMatch) {
            return response()->json([
                'message' => 'Data kecocokan untuk career ini tidak ditemukan. Jalankan proses match-career terlebih dahulu.',
            ], 422);
        }

        try {
            $result = $generator->generate(
                $analysisResult->skills_json ?? [],
                $careerMatch->skill_gap_json ?? [],
                $career->title
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        $careerMatch->update([
            'ai_summary' => $result['summary'],
            'roadmap_json' => $result['roadmap'],
        ]);

        if ($careerMatch->is_best_match) {
            $analysisResult->update([
                'ai_summary' => $result['summary'],
                'roadmap_json' => $result['roadmap'],
            ]);
        }

        return response()->json([
            'message' => 'Roadmap berhasil digenerate.',
            'data' => $careerMatch->fresh('career'),
        ]);
    }

    public function careerMatches(AnalysisResult $analysisResult)
    {
        abort_if($analysisResult->user_id !== auth()->id(), 403, 'Anda tidak berhak mengakses data ini.');

        $matches = $analysisResult->careerMatches()
            ->with('career')
            ->orderByDesc('match_score')
            ->get();

        return response()->json([
            'data' => $matches,
        ]);
    }

    public function targetAnalysis(AnalysisResult $analysisResult, Career $career)
    {
        abort_if($analysisResult->user_id !== auth()->id(), 403, 'Anda tidak berhak mengakses data ini.');

        $match = $analysisResult->careerMatches()
            ->where('career_id', $career->id)
            ->with('career')
            ->first();

        if (! $match) {
            return response()->json([
                'message' => 'Data kecocokan untuk career ini tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'data' => $match,
        ]);
    }

    public function showResult(AnalysisResult $analysisResult)
    {
        abort_if($analysisResult->user_id !== auth()->id(), 403, 'Anda tidak berhak mengakses data ini.');

        return response()->json([
            'data' => $analysisResult->load('career'),
        ]);
    }

    public function latestResult()
    {
        $analysisResult = AnalysisResult::with('career')
            ->where('user_id', auth()->id())
            ->latest()
            ->first();

        if (! $analysisResult) {
            return response()->json([
                'message' => 'Belum ada hasil analisis CV.',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'data' => $analysisResult,
        ]);
    }

    public function downloadPdf(AnalysisResult $analysisResult)
    {
        abort_if($analysisResult->user_id !== auth()->id(), 403, 'Anda tidak berhak mengakses data ini.');

        $analysisResult->load(['user', 'cvFile', 'career', 'careerMatches.career']);

        $pdf = Pdf::loadView('pdf.hasil-analisis', [
            'analysis' => $analysisResult,
        ]);

        $this->registerPdfFonts($pdf);

        return $pdf->download('hasil-analisis-'.$analysisResult->id.'.pdf');
    }

    private function registerPdfFonts(\Barryvdh\DomPDF\PDF $pdf): void
    {
        $fontDir = storage_path('fonts');
        $fontMetrics = $pdf->getDomPDF()->getFontMetrics();

        $fonts = [
            'Regular' => 'normal',
            'Medium' => '500',
            'SemiBold' => '600',
            'Bold' => 'bold',
        ];

        foreach ($fonts as $name => $weight) {
            $fontMetrics->registerFont([
                'family' => 'Inter',
                'weight' => $weight,
                'style' => 'normal',
            ], $fontDir.'/Inter/Inter-'.$name.'.ttf');
        }
    }

    public function history(Request $request)
    {
        $results = AnalysisResult::with('career')
            ->withCount('careerMatches')
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'data' => $results,
        ]);
    }
}
