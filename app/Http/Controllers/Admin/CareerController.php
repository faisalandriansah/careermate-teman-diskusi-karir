<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCareerRequest;
use App\Http\Requests\UpdateCareerRequest;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = Career::latest()->paginate(10);

        return response()->json($careers);
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
    public function store(StoreCareerRequest $request)
    {
        $career = Career::create($request->validated());

        return response()->json([
            'message' => 'Career berhasil ditambahkan.',
            'data' => $career,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        $career->load('skills', 'internships');

        return response()->json($career);
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
    public function update(UpdateCareerRequest $request, Career $career)
    {
        $career->update($request->validated());

        return response()->json([
            'message' => 'Career berhasil diperbarui.',
            'data' => $career,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();

        return response()->json([
            'message' => 'Career berhasil dihapus.',
        ]);
    }
}
