<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCareerSkillRequest;
use App\Models\Career;
use App\Models\Skill;

class CareerSkillController extends Controller
{
    // Tampilkan semua skill milik career tertentu beserta weight-nya
    public function index(Career $career)
    {
        // skill yang sudah mapping
        $mappedSkills = $career->skills()
            ->pluck('career_skills.weight', 'skills.id');

        //semua skill
        $skills = skill::all()->map(function ($skill) use ($mappedSkills) {
            return [
                'id' => $skill->id,
                'name' => $skill->name,
                'checked' => $mappedSkills->has($skill->id),
                'weight' => $mappedSkills[$skill->id] ?? 0,
            ];
        });

        // $career = Career::with('skills')->findOrFail($career->id);
        // $skills = $career->skills()->get();

        return response()->json([
            'career' => [
                'id' => $career->id,
                'title' => $career->title,
                'description' => $career->description,
            ],
            'skills' => $skills,
        ]);
    }

    // Simpan semua mapping skill sekaligus
    public function update(UpdateCareerSkillRequest $request, Career $career)
    {
        $syncData = [];

        foreach ($request->skills as $skill) {
            $syncData[$skill['skill_id']] = [
                'weight' => $skill['weight']
            ];
        }

        $career->skills()->sync($syncData);

        return response()->json([
            'message' => 'Career Skill Mapping berhasil diperbarui.',
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
