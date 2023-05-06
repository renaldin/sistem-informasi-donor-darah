<?php

use App\Http\Controllers\C_Dashboard;
use App\Http\Controllers\C_User;
use App\Http\Controllers\Register;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_PengajuanEvent;
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

    // profil
    Route::get('/profil', [C_User::class, 'profil'])->name('profil');
    Route::post('/edit_profil/{id}', [C_User::class, 'edit_profil']);
    Route::get('/ubah_password', [C_User::class, 'ubah_password'])->name('ubah_password');
    Route::post('/ubah_password/{id}', [C_User::class, 'proses_ubah_password']);

    // Dashboard
    Route::get('/dashboard', [C_Dashboard::class, 'index'])->name('dashboard');

    // Admin
    Route::group(['middleware' => 'admin'], function () {

        Route::get('/pengaturan-website', [PengaturanWeb::class, 'index'])->name('pengaturan-web');
        Route::post('/pengaturan-website/{id}', [PengaturanWeb::class, 'proses_edit']);

        // Kelola User
        Route::get('/data_user', [C_User::class, 'index'])->name('data_user');
        Route::get('/tambah_user', [C_User::class, 'tambah_user']);
        Route::post('/tambah_user', [C_User::class, 'proses_tambah_user']);
        Route::get('/edit_user/{id}', [C_User::class, 'edit_user'])->name('edit_user');
        Route::post('/edit_user/{id}', [C_User::class, 'proses_edit_user']);
        Route::get('/hapus_user/{id}', [C_User::class, 'hapus_user']);

        // Cetak PDF
        Route::post('/cetak-pdf', [Cetak::class, 'index']);
        Route::post('/cetak-pdf-order', [Cetak::class, 'cetakOrder']);
    });


    // Donatur
    Route::group(['middleware' => 'donatur'], function () {
    });


    // Event
    Route::group(['middleware' => 'event'], function () {
        // pengajuan event
        Route::get('/pengajuan_event', [C_PengajuanEvent::class, 'index'])->name('pengajuan_event');
        Route::get('/tambah_pengajuan_event', [C_PengajuanEvent::class, 'tambah_pengajuan_event'])->name('tambah_pengajuan_event');
        Route::post('/tambah_pengajuan_event', [C_PengajuanEvent::class, 'proses_tambah_pengajuan_event']);
        Route::get('/edit_pengajuan_event/{id}', [C_PengajuanEvent::class, 'edit_pengajuan_event'])->name('edit_pengajuan_event');
        Route::post('/edit_pengajuan_event/{id}', [C_PengajuanEvent::class, 'proses_edit_pengajuan_event']);
        Route::get('/hapus_pengajuan_event/{id}', [C_PengajuanEvent::class, 'hapus_pengajuan_event']);
        Route::get('/kirim_pengajuan_event/{id}', [C_PengajuanEvent::class, 'kirim_pengajuan_event']);
    });


    // Petugas Kesehatan
    Route::group(['middleware' => 'petugas_kesehatan'], function () {
    });


    // Rumah Sakit
    Route::group(['middleware' => 'rumah_sakit'], function () {
    });


    // Petugas Kesehatan
    Route::group(['middleware' => 'pusat_pmi'], function () {
    });
});
