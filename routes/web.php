<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\UpdateProfilController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/landing', [LandingController::class, 'showLandingPage'])->name('landing');
Route::resource('submissions', SubmissionController::class);

// Form submission
Route::get('/submissions/create', [SubmissionController::class, 'create'])->name('submissions.create');
Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');

// Login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::post('/masyarakatlogin', [LoginController::class, 'masyarakatlogin'])->name('masyarakatlogin');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Daftar
Route::get('/daftar', function () {
    return view('daftar.daftar');
});
Route::post('/daftar', [LoginController::class, 'daftar'])->name('daftar.post');

// Admin
Route::get('/admin/new', [AdminController::class, 'newSubmissions'])->name('admin.new');
Route::post('/admin/approve/{id}', [AdminController::class, 'approveSubmission'])->name('admin.approve');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::get('/admin/file/{id}', [AdminController::class, 'file'])->name('admin.file');
Route::post('/admin/upload-sk/{id}', [AdminController::class, 'uploadSk'])->name('admin.uploadSk');
Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');

// File
Route::get('/file/{id}/{type}', [FileController::class, 'show'])->name('file.show');
Route::get('/submissions/file/{id}', [MasyarakatController::class, 'file'])->name('submissions.file');
Route::get('/submissions/show-file/{id}/{type}', [SubmissionController::class, 'showFile'])->name('submissions.show_file');

// Google
Route::get('/auth/redirect', [SocialController::class, 'redirect'])->name('google.redirect');
Route::get('/google/redirect', [SocialController::class, 'googleCallback'])->name('google.callback');
Route::post('/login', [LoginController::class, 'googlelogin'])->name('googlelogin');

Route::get('/submissions/profil/{id}', [SubmissionController::class, 'profil'])->name('submissions.profil');
Route::get('/profil', [SubmissionController::class, 'showProfil'])->name('user.profil');

Route::get('/profil', [SubmissionController::class, 'profilmasyarakat'])->name('profil');
Route::get('/profil', [AdminController::class, 'profiladmin'])->name('profiladmin');
Route::post('/update-profil', [UpdateProfilController::class, 'update'])->name('update_profil');
