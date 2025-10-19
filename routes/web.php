<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])
    ->middleware('auth')
    ->name('profile.edit');

Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/hello', function () {
    return "Halo, ini halaman percobaan route!";
});

Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('apply.store')->middleware('auth');
Route::get('/jobs/{job}/applicants', [ApplicationController::class, 'index'])->name('applications.index')->middleware('isAdmin');
Route::post('/jobs/import', [JobController::class, 'import'])->name('jobs.import')->middleware('isAdmin');
Route::resource('jobs', JobController::class)->middleware(['auth', 'isAdmin'])->except(['index', 'show']);
Route::resource('jobs', JobController::class)->middleware(['auth'])->only(['index', 'show']);
Route::get('/applications/export', [ApplicationController::class, 'export'])->name('applications.export')->middleware('isAdmin');
Route::resource('applications', ApplicationController::class)->middleware(['auth', 'isAdmin'])->except(['index', 'show']);
Route::resource('applications', ApplicationController::class)->middleware(['auth'])->only(['index', 'show']);

Route::get('/admin', function () {
    return "Halaman Admin";
})->middleware(['auth', 'isAdmin']);

Route::get('/admin/jobs', [JobController::class, 'adminIndex'])
    ->middleware(['auth', 'isAdmin'])
    ->name('admin.jobs');
