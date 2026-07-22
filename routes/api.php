<?php

use App\Http\Controllers\Api\CVController;

Route::post('/cv/upload', [CVController::class, 'upload']);
Route::post('/cv/{cvFile}/extract', [CVController::class, 'extract']);