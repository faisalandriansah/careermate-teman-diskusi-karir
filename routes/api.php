<?php

use App\Http\Controllers\Api\CVController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\InternshipController;
use App\Http\Controllers\Admin\CareerSkillController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Api\StudentProfileController;
use Illuminate\Support\Facades\Route;

// Auth API
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'role:mahasiswa'])->group(function () {

    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // ✅ TAMBAHAN: route profil (tidak digating, ini yang melengkapi)
    Route::get('/student-profile', [StudentProfileController::class, 'show']);
    Route::put('/student-profile', [StudentProfileController::class, 'update']);

    // ✅ CV & Analysis sekarang digating middleware profile.complete
    Route::middleware('profile.complete')->group(function () {
        Route::post('/cv/upload', [CVController::class, 'upload']);
        Route::post('/cv/{cvFile}/extract', [CVController::class, 'extract']);
        Route::post('/cv/{cvFile}/detect-skills', [CVController::class, 'detectSkills']);
        Route::post('/analysis/{analysisResult}/match-career', [CVController::class, 'matchCareer']);
        Route::post('/analysis/{analysisResult}/generate-roadmap', [CVController::class, 'generateRoadmap']);
    });
});

Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::resource('skills', SkillController::class)
            ->except(['create', 'edit']);

        Route::resource('careers', CareerController::class)
            ->except(['create', 'edit']);

        Route::resource('internships', InternshipController::class)
            ->except(['create', 'edit']);

        Route::apiResource('students', StudentController::class)
            ->only(['index', 'show', 'destroy']);


        //mapping skill
        Route::get('careers/{career}/skills', [CareerSkillController::class, 'index']);
        Route::put('careers/{career}/skills', [CareerSkillController::class, 'update']);
    });
