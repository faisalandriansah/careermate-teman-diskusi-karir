<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInternshipRequest;
use App\Http\Requests\UpdateInternshipRequest;
use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $internships = Internship::with('career')->latest()->paginate(10);

        return response()->json($internships);
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
    public function store(StoreInternshipRequest $request)
    {
        $internship = Internship::create($request->validated());

        return response()->json([
            'message' => 'Internship berhasil ditambahkan.',
            'data' => $internship,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Internship $internship)
    {
        $internship->load('career');

        return response()->json($internship);
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
    public function update(UpdateInternshipRequest $request, Internship $internship)
    {
        $internship->update($request->validated());

        return response()->json([
            'message' => 'Internship berhasil diperbarui.',
            'data' => $internship,
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Internship $internship)
    {
        $internship->delete();

        return response()->json([
            'message' => 'Internship berhasil dihapus.',
        ]);
    }
}
