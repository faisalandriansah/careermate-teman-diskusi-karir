<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\InternshipController;
use App\Http\Controllers\Admin\CareerSkillController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::prefix('admin')
    ->middleware(['auth:sanctum', 'role:admin'])
    ->group(function () {

        Route::resource('skills', SkillController::class)
            ->except(['create', 'edit']);

        Route::resource('careers', CareerController::class)
            ->except(['create', 'edit']);

        Route::resource('internships', InternshipController::class)
            ->except(['create', 'edit']);
    });

Route::view('/{any?}', 'app')
    ->where('any', '.*');

require __DIR__ . '/auth.php';
