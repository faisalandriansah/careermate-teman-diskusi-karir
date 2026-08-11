<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    public function show(Request $request)
    {
        $profile = $request->user()->studentProfile;

        return response()->json([
            'profile' => $profile,
            'is_complete' => $request->user()->hasCompleteProfile(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'university'     => ['required', 'string', 'max:255'],
            'major'          => ['required', 'string', 'max:255'],
            'semester'       => ['required', 'string', 'max:10'],
            'phone'          => ['required', 'string', 'max:20'],
            'github_url'     => ['nullable', 'url', 'max:255'],
            'linkedin_url'   => ['nullable', 'url', 'max:255'],
            'portfolio_url'  => ['nullable', 'url', 'max:255'],
        ]);

        $profile = StudentProfile::updateOrCreate(
            ['user_id' => $request->user()->id],
            $validated
        );

        return response()->json([
            'message' => 'Profil berhasil diperbarui.',
            'profile' => $profile,
            'is_complete' => $profile->isComplete(),
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $profile = $request->user()->studentProfile;

        if (!$profile) {
            return response()->json([
                'message' => 'Lengkapi data profil terlebih dahulu sebelum upload foto.',
            ], 422);
        }

        if ($profile->photo_path) {
            Storage::disk('public')->delete($profile->photo_path);
        }

        $file = $request->file('photo');
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('profile-photos', $fileName, 'public');

        $profile->update(['photo_path' => $path]);

        return response()->json([
            'message' => 'Foto profil berhasil diperbarui.',
            'photo_url' => $profile->fresh()->photo_url,
        ]);
    }
}
