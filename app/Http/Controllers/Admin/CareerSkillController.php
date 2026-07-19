<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCareerSkillRequest;
use App\Models\Career;

class CareerSkillController extends Controller
{
    // Tampilkan semua skill milik career tertentu beserta weight-nya
    public function index(Career $career)
    {
        $skills = $career->skills()->get();

        return response()->json([
            'career' => $career->only('id', 'title'),
            'skills' => $skills,
        ]);
    }

    // Tambah / update mapping skill ke career (attach kalau belum ada, update weight kalau udah ada)
    public function update(UpdateCareerSkillRequest $request, Career $career)
    {
        $validated = $request->validated();

        $career->skills()->syncWithoutDetaching([
            $validated['skill_id'] => ['weight' => $validated['weight']],
        ]);

        return response()->json([
            'message' => 'Career-Skill mapping berhasil diupdate.',
            'data' => $career->skills()->get(),
        ]);
    }

    // Hapus mapping skill dari career
    public function destroy(Career $career, $skillId)
    {
        $career->skills()->detach($skillId);

        return response()->json([
            'message' => 'Skill berhasil dihapus dari career.',
        ]);
    }
}