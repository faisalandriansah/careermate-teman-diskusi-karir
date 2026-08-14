<?php

use App\Http\Controllers\Api\CVController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\InternshipController;
use App\Http\Controllers\Admin\CareerSkillController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Api\StudentProfileController;
use Illuminate\Support\Facades\Route;

// 1. PUBLIC AUTH ROUTES
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// 2. AUTHENTICATED COMMON ROUTES (Bisa diakses Admin maupun Mahasiswa)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

// 3. STUDENT ROUTES (Khusus Mahasiswa)
Route::middleware(['auth:sanctum', 'role:mahasiswa'])
    ->prefix('student')
    ->group(function () {

        // Route profil mahasiswa
        Route::get('/profile', [StudentProfileController::class, 'show']);
        Route::put('/profile', [StudentProfileController::class, 'update']);
        Route::post('/profile/photo', [StudentProfileController::class, 'uploadPhoto']);

        // CV & Analysis (memerlukan profil lengkap)
        Route::middleware('profile.complete')->group(function () {
            Route::post('/cv/upload', [CVController::class, 'upload']);
            Route::post('/cv/{cvFile}/extract', [CVController::class, 'extract']);
            Route::post('/cv/{cvFile}/detect-skills', [CVController::class, 'detectSkills']);
            Route::post('/analysis/{analysisResult}/match-career', [CVController::class, 'matchCareer']);
            Route::get('/analysis/{analysisResult}/careers', [CVController::class, 'careerMatches']);
            Route::get('/analysis/{analysisResult}/careers/{career}', [CVController::class, 'targetAnalysis']);
            Route::post('/analysis/{analysisResult}/careers/{career}/generate-roadmap', [CVController::class, 'generateRoadmap']);
            Route::get('/analysis/history', [CVController::class, 'history']);
            Route::get('/analysis/latest', [CVController::class, 'latestResult']);
            Route::get('/analysis/{analysisResult}', [CVController::class, 'showResult']);
            Route::get('/analysis/{analysisResult}/pdf', [CVController::class, 'downloadPdf']); //download pdf
        });
    });

// 4. ADMIN ROUTES (Khusus Admin)
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

        Route::get('analysis/history', [StudentController::class, 'analysisHistory']);

        Route::get('students/{student}/cv/{cvFile}', [StudentController::class, 'showCV']);

        // Notifikasi admin
        Route::get('notifications', [NotificationController::class, 'index']);
        Route::post('notifications/read-all', [NotificationController::class, 'markAllRead']);
        Route::post('notifications/{notification}/read', [NotificationController::class, 'markRead']);

        // Mapping skill
        Route::get('careers/{career}/skills', [CareerSkillController::class, 'index']);
        Route::put('careers/{career}/skills', [CareerSkillController::class, 'update']);
    });
