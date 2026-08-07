<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CVFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query()
            ->where('role', 'mahasiswa')
            ->with([
                'studentProfile',
                'cvFiles' => function ($q) {
                    $q->select(['id', 'user_id', 'file_name', 'file_path', 'created_at'])
                        ->latest()->limit(1); // ambil cv terbaru saja (tanpa extracted_text yang berat)
                },
                'analysisResults' => function ($q) {
                    $q->select(['id', 'user_id', 'career_id', 'match_score', 'skills_json', 'created_at'])
                        ->latest()->limit(1)->with('career:id,title'); // ambil analisis terbaru + nama karir
                },
            ]);

        // search by name/email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $mahasiswa = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 1000));

        return response()->json($mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Detail 1 student lengkap (buat modal detail / share link)
     * GET /admin/students/{id}
     */
    public function show($id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')
            ->with([
                'studentProfile',
                'cvFiles' => function ($q) {
                    $q->latest()->limit(1);
                },
                'analysisResults' => function ($q) {
                    $q->latest()->limit(1)->with('career');
                },
            ])
            ->findOrFail($id);

        return response()->json($mahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        $mahasiswa->delete();

        return response()->json([
            'message' => 'mahasiswa berhasil dihapus'
        ]);
    }

    /**
     * Stream / preview file CV milik mahasiswa.
     * GET /admin/students/{student}/cv/{cvFile}
     */
    public function showCV(User $student, CVFile $cvFile)
    {
        abort_if($cvFile->user_id !== $student->id, 404, 'CV tidak ditemukan.');

        $fullPath = Storage::disk('public')->path($cvFile->file_path);

        abort_if(!file_exists($fullPath), 404, 'File CV tidak ditemukan.');

        return response()->file($fullPath);
    }
}
