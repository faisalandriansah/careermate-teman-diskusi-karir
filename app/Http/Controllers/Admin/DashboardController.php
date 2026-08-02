<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Skill;
use App\Models\Career;
use App\Models\Internship;
use App\Models\CVFile;
use App\Models\CareerSkill;
use App\Models\AnalysisResult;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $sudahUpload = CVFile::distinct('user_id')->count('user_id');
        $belumUpload = max($totalMahasiswa - $sudahUpload, 0);
        $totalAnalisis = AnalysisResult::count();

        return response()->json([
            'summary' => [
                'mahasiswa' => $totalMahasiswa,
                'skill' => Skill::count(),
                'career' => Career::count(),
                'magang' => Internship::count(),
            ],

            'usage_stats' => [
                'sudah_upload' => $sudahUpload,
                'belum_upload' => $belumUpload,
                'total_analisis' => $totalAnalisis,
            ],

            'career_distribution' => AnalysisResult::select('career_id', DB::raw('count(*) as total'))
                ->with('career:id,title')
                ->groupBy('career_id')
                ->orderByDesc('total')
                ->limit(5)
                ->get()
                ->map(fn($row) => [
                    'label' => $row->career->title ?? 'Unknown',
                    'value' => $row->total,
                ]),

            'popular_skills' => CareerSkill::select('skill_id', DB::raw('count(*) as total'), DB::raw('sum(weight) as total_weight'))
                ->with('skill:id,name')
                ->groupBy('skill_id')
                ->orderByDesc('total_weight')
                ->limit(3)
                ->get()
                ->map(fn($row) => [
                    'name' => $row->skill->name ?? 'Unknown',
                    'count' => $row->total,
                ]),

            'recent_activities' => $this->getRecentActivities(),
        ]);
    }

    private function getRecentActivities()
    {
        $uploads = CVFile::select('user_id as ref_id', 'file_name as detail', 'created_at')
            ->selectRaw("'upload_cv' as type")
            ->latest()
            ->limit(5)
            ->get();

        $registrations = User::where('role', 'mahasiswa')
            ->select('id as ref_id', 'name as detail', 'created_at')
            ->selectRaw("'registrasi' as type")
            ->latest()
            ->limit(5)
            ->get();

        $analyses = AnalysisResult::select('user_id as ref_id', 'match_score as detail', 'created_at')
            ->selectRaw("'analisis' as type")
            ->latest()
            ->limit(5)
            ->get();

        return $uploads->concat($registrations)->concat($analyses)
            ->sortByDesc('created_at')
            ->take(5)
            ->map(function ($item) {
                $labels = [
                    'upload_cv' => 'Upload CV',
                    'registrasi' => 'Registrasi',
                    'analisis' => 'Analisis selesai',
                ];
                $details = [
                    'upload_cv' => "File \"{$item->detail}\" diunggah",
                    'registrasi' => "{$item->detail} mendaftar sebagai mahasiswa",
                    'analisis' => "Skor kecocokan {$item->detail}% dihasilkan",
                ];
                return [
                    'title' => $labels[$item->type],
                    'detail' => $details[$item->type],
                    'time' => $item->created_at->diffForHumans(),
                ];
            })
            ->values();
    }
}
