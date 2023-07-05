<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Jobs
Route::get('/', [JobController::class, 'index'])->name('jobs');
Route::get('job/{job}', [JobController::class, 'view'])->name('job.view');

// Pages
Route::get('about-as', [JobController::class, 'page'])->name('about');
Route::get('contact-us', [JobController::class, 'page'])->name('contact');
Route::get('sitemap.xml', [JobController::class, 'sitemap'])->name('sitemap');
Route::get('terms-conditions', [JobController::class, 'page'])->name('terms');

//Cron
Route::get('cron', [JobController::class, 'cron']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('jobs-import', [JobController::class, 'import'])->name('jobs.import');
    Route::post('jobs-import', [JobController::class, 'storeImport'])->name('jobs.storeImport');
    Route::post('jobs-options', [JobController::class, 'storeOptions'])->name('jobs.storeOptions');
});

require __DIR__.'/auth.php';
