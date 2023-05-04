<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Users;
use App\Http\Controllers\Register;
use App\Http\Controllers\Login;
use App\Http\Controllers\Cetak;
use App\Http\Controllers\PengaturanWeb;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'revalidate'], function () {

    // login
    Route::get('/', [Login::class, 'index'])->name('login');
    Route::post('/login', [Login::class, 'login']);

    // Logout
    Route::get('/logout', [Login::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'pegawai'], function () {
        // dashboard
        Route::get('/dashboardPegawai', [Dashboard::class, 'index'])->name('dashboardPegawai');

        // Profil User
        Route::get('/profil', [Users::class, 'profil'])->name('profil');
        Route::post('/profil/{id}', [Users::class, 'editProfilProcess']);
        Route::post('/ubah-password/{id}', [Users::class, 'changePasswordProcess']);
    });

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboardAdmin', [Dashboard::class, 'index'])->name('dashboardAdmin');

        Route::get('/pengaturan-website', [PengaturanWeb::class, 'index'])->name('pengaturan-web');
        Route::post('/pengaturan-website/{id}', [PengaturanWeb::class, 'proses_edit']);

        // Kelola User
        Route::get('/kelola-user', [Users::class, 'index'])->name('kelola-user');
        Route::get('/tambah-user', [Users::class, 'add'])->name('tambah-user');
        Route::post('/tambah-user', [Users::class, 'addProcess']);
        Route::get('/edit-user/{id}', [Users::class, 'edit'])->name('edit-user');
        Route::post('/edit-user/{id}', [Users::class, 'editProcess']);
        Route::get('/detail-user/{id}', [Users::class, 'detail'])->name('detail-user');
        Route::get('/hapus-user/{id}', [Users::class, 'deleteProcess']);

        // profil
        Route::get('/profil-admin', [Users::class, 'profil'])->name('profil-admin');
        Route::post('/profil-admin/{id}', [Users::class, 'editProfilProcess']);
        Route::post('/ubah-password-admin/{id}', [Users::class, 'changePasswordProcess']);

        // Cetak PDF
        Route::post('/cetak-pdf', [Cetak::class, 'index']);
        Route::post('/cetak-pdf-order', [Cetak::class, 'cetakOrder']);
    });

    Route::group(['middleware' => 'wakildirektur'], function () {
        // dashboard
        Route::get('/dashboardWadir', [Dashboard::class, 'index'])->name('dashboardWadir');

        // Profil User
        Route::get('/profil-wadir', [Users::class, 'profil'])->name('profil-wadir');
        Route::post('/profil-wadir/{id}', [Users::class, 'editProfilProcess']);
        Route::post('/ubah-password-wadir/{id}', [Users::class, 'changePasswordProcess']);
    });

    Route::group(['middleware' => 'ketuajurusan'], function () {
        // dashboard
        Route::get('/dashboardKajur', [Dashboard::class, 'index'])->name('dashboardKajur');

        // Profil User
        Route::get('/profil-kajur', [Users::class, 'profil'])->name('profil-kajur');
        Route::post('/profil-kajur/{id}', [Users::class, 'editProfilProcess']);
        Route::post('/ubah-password-kajur/{id}', [Users::class, 'changePasswordProcess']);
    });
});
