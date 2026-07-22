<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadCVRequest;
use App\Models\CVFile;
use App\Services\PDFExtractorService;
use Illuminate\Support\Str;
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
}
