<?php

use App\Http\Controllers\Api\CVController;
use App\Http\Controllers\Api\AuthController;

// Auth API
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// 
Route::middleware(['auth:sanctum','role:mahasiswa'])->group(function () {

    Route::get('/auth/me', [AuthController::class, 'me']);

    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::post('/cv/upload', [CVController::class, 'upload']);
    Route::post('/cv/{cvFile}/extract', [CVController::class, 'extract']);
    Route::post('/cv/{cvFile}/detect-skills', [CVController::class, 'detectSkills']);
    Route::post('/analysis/{analysisResult}/match-career', [CVController::class, 'matchCareer']);
    Route::post('/analysis/{analysisResult}/generate-roadmap', [CVController::class, 'generateRoadmap']);
});
