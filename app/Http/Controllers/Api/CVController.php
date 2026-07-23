<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadCVRequest;
use App\Models\CVFile;
use App\Models\AnalysisResult;
use App\Services\PDFExtractorService;
use Illuminate\Support\Str;
use App\Services\SkillDetectionService;
use App\Services\CareerMatchingService;
use App\Services\RoadmapGeneratorService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CVController extends Controller
{
    public function upload(UploadCVRequest $request)
    {
        $validated = $request->validated();

        $file = $request->file('cv');

        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $filePath = $file->storeAs('cv', $fileName, 'public');

        $cvFile = CVFile::create([
            'user_id' => $validated['user_id'],
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'mime_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return response()->json([
            'messgae' => 'CV berhasil diupload.',
            'data' => $cvFile,
        ], 201);
    }

    public function extract(CVFile $cvFile, PDFExtractorService $extractor)
    {
        $fullPath = Storage::disk('public')->path($cvFile->file_path);

        if (!file_exists($fullPath)) {
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

    public function matchCareer(AnalysisResult $analysisResult, CareerMatchingService $matcher)
    {
        if (empty($analysisResult->skills_json)) {
            return response()->json([
                'message' => 'Analysis result ini belum memiliki data skill. Jalankan proses detect-skills terlebih dahulu.',
            ], 422);
        }

        $result = $matcher->match($analysisResult->skills_json);

        if (!$result['career']) {
            return response()->json([
                'message' => 'Tidak ditemukan career yang cocok. Pastikan data career_skills sudah diisi.',       
            ], 404);
        }

        $analysisResult->update([
            'career_id' => $result['career']->id,
            'match_score' => $result['match_score'],
            'skill_gap_json' => $result['skill_gap'],
        ]);

        return response()->json([
            'message' => 'Career matching berhasil.',
            'data' => $analysisResult->fresh('career'),
        ]);
    }

    public function generateRoadmap(AnalysisResult $analysisResult, RoadmapGeneratorService $generator)
    {
        if (empty($analysisResult->career_id)) {
            return response()->json([
                'message' => 'Analysis result ini belum memiliki career. Jalankan proses match-career terlebih dahulu.',
            ], 422);
        }
        $analysisResult->load('career');

        try {
            $result = $generator->generate(
                $analysisResult->skills_json ?? [],
                $analysisResult->skill_gap_json ?? [],
                $analysisResult->career->title
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        $analysisResult->update([
            'ai_summary' => $result['summary'],
            'roadmap_json' => $result['roadmap'],
        ]);

        return response()->json([
            'message' => 'Roadmap berhasil digenerate.',
            'data' => $analysisResult->fresh('career'),
        ]);
    }
}
