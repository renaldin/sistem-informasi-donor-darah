<?php

use App\Http\Controllers\C_Dashboard;
use App\Http\Controllers\C_User;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_PengajuanEvent;
use App\Http\Controllers\C_PermohonanDarah;
use App\Http\Controllers\C_Register;
use App\Http\Controllers\C_Darah;
use App\Http\Controllers\C_Anggota;
use App\Http\Controllers\C_Donatur;
use App\Http\Controllers\C_LandingPage;
use App\Http\Controllers\C_StokDarah;
use App\Http\Controllers\C_Laporan;
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

    // Route::group(['middleware' => 'landing_page'], function () {
    // lading page
    Route::get('/', [C_LandingPage::class, 'index'])->name('landingpage');
    // });

    // login
    Route::get('/login', [C_Login::class, 'index'])->name('login');
    Route::post('/login', [C_Login::class, 'login']);
    Route::get('/lupa_password', [C_Login::class, 'lupa_password'])->name('lupa_password');
    Route::post('/lupa_password', [C_Login::class, 'proses_lupa_password']);
    Route::get('/reset_password/{id}', [C_Login::class, 'reset_password'])->name('reset_password');
    Route::post('/reset_password/{id}', [C_Login::class, 'proses_reset_password']);

    // Register
    Route::get('/register', [C_Register::class, 'index'])->name('register');
    Route::post('/register', [C_Register::class, 'register']);

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

        // Kelola darah
        Route::get('/data_stok_darah', [C_StokDarah::class, 'index'])->name('data_stok_darah');
        Route::get('/tambah_darah_online', [C_StokDarah::class, 'tambah_darah_online'])->name('tambah_darah_online');
        Route::post('/tambah_darah_online', [C_StokDarah::class, 'proses_tambah_darah']);
        Route::get('/tambah_darah_offline', [C_StokDarah::class, 'tambah_darah_offline'])->name('tambah_darah_offline');
        Route::get('/tambah_darah_offline_anggota', [C_StokDarah::class, 'tambah_darah_offline_anggota'])->name('tambah_darah_offline_anggota');
        Route::post('/tambah_darah_offline', [C_StokDarah::class, 'proses_tambah_darah']);
        Route::get('/edit_darah/{id}', [C_StokDarah::class, 'edit_darah'])->name('edit_darah');
        Route::post('/edit_darah/{id}', [C_StokDarah::class, 'proses_edit_darah']);
        Route::get('/buang_darah/{id}', [C_StokDarah::class, 'buang_darah'])->name('buang_darah');
        Route::get('/riwayat_buang_darah', [C_StokDarah::class, 'riwayat_buang_darah'])->name('riwayat_buang_darah');

        // Data Pengajuan Event
        Route::get('/data_pengajuan_event', [C_PengajuanEvent::class, 'kelola_pengajuan_event'])->name('data_pengajuan_event');
        Route::get('/tidak_pengajuan_event/{id}', [C_PengajuanEvent::class, 'tidak_pengajuan_event']);
        Route::get('/ya_pengajuan_event/{id}', [C_PengajuanEvent::class, 'ya_pengajuan_event']);
        Route::get('/riwayat_pengajuan_event', [C_PengajuanEvent::class, 'riwayat_pengajuan_event'])->name('riwayat_pengajuan_event');
        Route::get('/tambah_event', [C_PengajuanEvent::class, 'tambah_event'])->name('tambah_event');
        Route::post('/tambah_event', [C_PengajuanEvent::class, 'proses_tambah_event']);
        Route::get('/edit_event/{id}', [C_PengajuanEvent::class, 'edit_event'])->name('edit_event');
        Route::post('/edit_event/{id}', [C_PengajuanEvent::class, 'proses_edit_event']);
        Route::get('/hapus_event/{id}', [C_PengajuanEvent::class, 'hapus_pengajuan_event']);
        Route::get('/jadwal_event', [C_PengajuanEvent::class, 'jadwal_event'])->name('jadwal_event');
        Route::get('/selesai_event/{id}', [C_PengajuanEvent::class, 'selesai_event']);
        Route::get('/tambah_darah_event/{id}', [C_PengajuanEvent::class, 'tambah_darah_event'])->name('tambah_darah_event');
        Route::post('/tambah_darah_event/{id}', [C_PengajuanEvent::class, 'proses_tambah_darah_event']);
        Route::get('/detail_event/{id}', [C_PengajuanEvent::class, 'detail_event'])->name('detail_event');

        // Data Permohonan Darah
        Route::get('/distribusi_darah', [C_PermohonanDarah::class, 'distribusi_darah'])->name('distribusi_darah');
        Route::get('/riwayat_distribusi_darah', [C_PermohonanDarah::class, 'riwayat_distribusi_darah'])->name('riwayat_distribusi_darah');
        Route::get('/keluarkan_darah/{id}', [C_PermohonanDarah::class, 'keluarkan_darah'])->name('keluarkan_darah');
        Route::post('/keluarkan_darah/{id}', [C_PermohonanDarah::class, 'proses_keluarkan_darah']);
        Route::get('/kirim_distribusi_darah/{id}', [C_PermohonanDarah::class, 'kirim_distribusi_darah'])->name('kirim_distribusi_darah');
        Route::get('/hapus_darah_keluar/{id}', [C_PermohonanDarah::class, 'hapus_darah_keluar'])->name('hapus_darah_keluar');

        // Data Permohonan Darah
        Route::get('/anggota', [C_Anggota::class, 'index'])->name('anggota');

        // laporan
        Route::get('/laporan_darah_masuk', [C_Laporan::class, 'index'])->name('laporan_darah_masuk');
        Route::get('/laporan_darah_keluar', [C_Laporan::class, 'darah_keluar'])->name('laporan_darah_keluar');
        Route::get('/laporan_darah_buang', [C_Laporan::class, 'darah_buang'])->name('laporan_darah_buang');

        Route::post('/cetak_darah_masuk', [C_Laporan::class, 'cetak_darah_masuk'])->name('cetak_darah_masuk');
        Route::post('/cetak_darah_keluar', [C_Laporan::class, 'cetak_darah_keluar'])->name('cetak_darah_keluar');
        Route::post('/cetak_darah_buang', [C_Laporan::class, 'cetak_darah_buang'])->name('cetak_darah_keluar');
    });


    // Donatur
    Route::group(['middleware' => 'donatur'], function () {
        // Daftar Donor
        Route::get('/daftar_donor', [C_Donatur::class, 'index'])->name('daftar_donor');
        Route::post('/submit_kuisioner', [C_Donatur::class, 'submit_kuisioner'])->name('submit_kuisioner');
        Route::get('/riwayat_donor', [C_Donatur::class, 'riwayat_donor'])->name('riwayat_donor');
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
        // permohonan dfarah
        Route::get('/permohonan_darah', [C_PermohonanDarah::class, 'index'])->name('permohonan_darah');
        Route::get('/tambah_permohonan_darah', [C_PermohonanDarah::class, 'tambah_permohonan_darah'])->name('tambah_permohonan_darah');
        Route::post('/tambah_permohonan_darah', [C_PermohonanDarah::class, 'proses_tambah_permohonan_darah']);
        Route::get('/batal_permohonan_darah/{id}', [C_PermohonanDarah::class, 'batal_permohonan_darah'])->name('batal_permohonan_darah');
        Route::get('/edit_permohonan_darah/{id}', [C_PermohonanDarah::class, 'edit_permohonan_darah'])->name('edit_permohonan_darah');
        Route::post('/edit_permohonan_darah/{id}', [C_PermohonanDarah::class, 'proses_edit_permohonan_darah']);
        Route::get('/kirim_permohonan_darah/{id}', [C_PermohonanDarah::class, 'kirim_permohonan_darah'])->name('kirim_permohonan_darah');
        Route::get('/terima_permohonan_darah/{id}', [C_PermohonanDarah::class, 'terima_permohonan_darah'])->name('terima_permohonan_darah');

        // riwayat permohonan darah
        Route::get('/riwayat_permohonan_darah', [C_PermohonanDarah::class, 'riwayat_permohonan_darah'])->name('riwayat_permohonan_darah');
    });
});
