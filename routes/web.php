<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PemerintahController;
use App\Http\Controllers\SubmissionController;

Route::get('/', fn () => view('pages.home'))->name('home');

Route::get('/pemerintah', [PemerintahController::class, 'index'])
    ->name('pemerintah');

Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('show');
});
Route::get('/layanan', fn () => view('pages.layanan'))->name('layanan');

Route::post('/submission', [SubmissionController::class, 'store'])
    ->name('submission.store');

Route::get('/tracking/{code}', [SubmissionController::class, 'track'])
    ->name('submission.track');