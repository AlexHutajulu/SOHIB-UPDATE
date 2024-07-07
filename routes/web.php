<?php

use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\UpdateProfilController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\MapsController;

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
Route::get('/submission/{id}', [AdminController::class, 'detail'])->name('submission.detail');
Route::get('/admin/maps', [MapsController::class, 'adminmaps'])->name('adminmaps');
Route::post('maps', [MapsController::class, 'store'])->name('maps.store');
Route::get('/maps', [MapsController::class, 'showMaps'])->name('maps.show');
//profil
Route::get('/submissions/profil/{id}', [SubmissionController::class, 'show'])->name('submissions.profil');
Route::get('/submissions/profil', [MasyarakatController::class, 'profilmasyarakat'])->name('profilmasyarakat');
Route::get('/kelurahan/profil', [KelurahanController::class, 'profilkelurahan'])->name('profilkelurahan');
Route::get('/admin/profil', [AdminController::class, 'profiladmin'])->name('profiladmin');
Route::get('/profil', [PimpinanController::class, 'profilpimpinan'])->name('profilpimpinan');
Route::post('/update-profil', [UpdateProfilController::class, 'update'])->name('update_profil');
//landing
Route::get('/landing', [LandingController::class, 'showLandingPage'])->name('landing');
Route::resource('submissions', SubmissionController::class);
Route::get('/kelurahan/permohonan', [KelurahanController::class, 'pengajuan'])->name('kelurahan.permohonan');
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
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/new', [AdminController::class, 'newSubmissions'])->name('admin.new');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approveSubmission'])->name('admin.approve');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/status', [AdminController::class, 'status'])->name('admin.submission-table');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/file/{id}', [AdminController::class, 'file'])->name('admin.file');
    Route::post('/admin/upload-sk/{id}', [AdminController::class, 'uploadSk'])->name('admin.uploadSk');
    Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
});
// File
Route::get('/file/{id}/{type}', [FileController::class, 'show'])->name('file.show');
Route::get('/submissions/file/{id}', [MasyarakatController::class, 'file'])->name('submissions.file');
Route::get('/submissions/show-file/{id}/{type}', [SubmissionController::class, 'showFile'])->name('submissions.show_file');
Route::get('/submissions/{id}/public/{type}', [SubmissionController::class, 'downloadFile'])->name('submissions.download_file');
// Google
Route::get('/auth/redirect', [SocialController::class, 'redirect'])->name('google.redirect');
Route::get('/google/redirect', [SocialController::class, 'googleCallback'])->name('google.callback');
Route::post('/login', [LoginController::class, 'googlelogin'])->name('googlelogin');
//kelurahan
Route::get('/permohonan', [KelurahanController::class, 'permohonan'])->name('permohonan');
Route::middleware(['auth', 'role:kelurahan'])->group(function () {
    Route::get('/kelurahan', [KelurahanController::class, 'index'])->name('kelurahan.index');
    Route::prefix('kelurahan')->group(function () {
        Route::post('/surat_kelurahan/{submissionId}', [KelurahanController::class, 'store'])
            ->name('surat_kelurahan.upload');
    });
});
Route::get('/surat_kelurahan/show/{id}', [KelurahanController::class, 'show'])->name('surat_kelurahan.show');
Route::get('/surat_kelurahan/download/{id}', [KelurahanController::class, 'download'])->name('surat_kelurahan.download');
Route::middleware(['auth', 'role:pimpinan'])->group(function () {
    Route::get('/pimpinan', [PimpinanController::class, 'index'])->name('pimpinan.index');
    Route::get('/data/permohonan', [PimpinanController::class, 'datapermohonan'])->name('datapermohonan');
    Route::get('/submission/{id}', [PimpinanController::class, 'detaildata'])->name('pimpinan.permohonan');
});

