<?php

use App\Http\Controllers\C_Dashboard;
use App\Http\Controllers\Users;
use App\Http\Controllers\Register;
use App\Http\Controllers\C_Login;
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
    Route::get('/', [C_Login::class, 'index'])->name('login');
    Route::post('/login', [C_Login::class, 'login']);

    // Logout
    Route::get('/logout', [C_Login::class, 'logout'])->name('logout');

    // Admin
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/dashboard_admin', [C_Dashboard::class, 'index'])->name('dashboard_admin');

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


    // Donatur
    Route::group(['middleware' => 'donatur'], function () {
        // dashboard
        Route::get('/dashboard_donatur', [C_Dashboard::class, 'index'])->name('dashboard_donatur');

        // Profil User
        Route::get('/profil', [Users::class, 'profil'])->name('profil');
        Route::post('/profil/{id}', [Users::class, 'editProfilProcess']);
        Route::post('/ubah-password/{id}', [Users::class, 'changePasswordProcess']);
    });


    // Event
    Route::group(['middleware' => 'event'], function () {
        // dashboard
        Route::get('/dashboard_event', [C_Dashboard::class, 'index'])->name('dashboard_event');

        // Profil User
        Route::get('/profil-wadir', [Users::class, 'profil'])->name('profil-wadir');
        Route::post('/profil-wadir/{id}', [Users::class, 'editProfilProcess']);
        Route::post('/ubah-password-wadir/{id}', [Users::class, 'changePasswordProcess']);
    });


    // Petugas Kesehatan
    Route::group(['middleware' => 'petugas_kesehatan'], function () {
        // dashboard
        Route::get('/dashboard_petugas_kesehatan', [C_Dashboard::class, 'index'])->name('dashboard_petugas_kesehatan');

        // Profil User
        Route::get('/profil-kajur', [Users::class, 'profil'])->name('profil-kajur');
        Route::post('/profil-kajur/{id}', [Users::class, 'editProfilProcess']);
        Route::post('/ubah-password-kajur/{id}', [Users::class, 'changePasswordProcess']);
    });


    // Rumah Sakit
    Route::group(['middleware' => 'rumah_sakit'], function () {
        // dashboard
        Route::get('/dashboard_rumah_sakit', [C_Dashboard::class, 'index'])->name('dashboard_rumah_sakit');

        // Profil User
        Route::get('/profil-kajur', [Users::class, 'profil'])->name('profil-kajur');
        Route::post('/profil-kajur/{id}', [Users::class, 'editProfilProcess']);
        Route::post('/ubah-password-kajur/{id}', [Users::class, 'changePasswordProcess']);
    });


    // Petugas Kesehatan
    Route::group(['middleware' => 'pusat_pmi'], function () {
        // dashboard
        Route::get('/dashboard_pusat_pmi', [C_Dashboard::class, 'index'])->name('dashboard_pusat_pmi');

        // Profil User
        Route::get('/profil-kajur', [Users::class, 'profil'])->name('profil-kajur');
        Route::post('/profil-kajur/{id}', [Users::class, 'editProfilProcess']);
        Route::post('/ubah-password-kajur/{id}', [Users::class, 'changePasswordProcess']);
    });
});
