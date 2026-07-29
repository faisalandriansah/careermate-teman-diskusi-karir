<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query()
            ->where('role', 'student')
            ->with([
                'profile',
                'cvFiles' => function ($q) {
                    $q->latest()->limit(1); // ambil cv terbaru saja
                },
                'analysisResults' => function ($q) {
                    $q->latest()->limit(1)->with('career'); // ambil analisis terbaru + nama karir
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

        $students = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 1000));

        return response()->json($students);
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
        $student = User::where('role', 'student')
            ->with([
                'profile',
                'cvFiles' => function ($q) {
                    $q->latest()->limit(1);
                },
                'analysisResults' => function ($q) {
                    $q->latest()->limit(1)->with('career');
                },
            ])
            ->findOrFail($id);

        return response()->json($student);
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
        $student = User::where('role', 'student')->findOrFail($id);
        $student->delete();

        return response()->json([
            'message' => 'Student berhasil dihapus'
        ]);
    }
}
