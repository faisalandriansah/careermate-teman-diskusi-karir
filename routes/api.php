<?php

use App\Http\Controllers\Api\CVController;

Route::post('/cv/upload', [CVController::class, 'upload']);
Route::post('/cv/{cvFile}/extract', [CVController::class, 'extract']);
Route::post('/cv/{cvFile}/detect-skills', [CVController::class, 'detectSkills']);
Route::post('/analysis/{analysisResult}/match-career', [CVController::class, 'matchCareer']);
Route::post('/analysis/{analysisResult}/generate-roadmap', [CVController::class, 'generateRoadmap']);
