<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesertaController;
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

Route::get('/',function(){
    return redirect('login');
});
Route::get('login',[AuthController::class,'index']);
Route::post('login_proses',[AuthController::class,'proses_login']);
Route::get('daftar',[AuthController::class,'daftar']);
Route::post('daftar_proses',[AuthController::class,'proses_daftar']);

Route::group(['middleware' => 'auth'],function(){
    Route::post('logout',[AuthController::class,'logout']);

    Route::group(['middleware' => 'cek_login:peserta'],function(){
        Route::get('peserta',[PesertaController::class,'index']);
        Route::get('peserta/biodata',[PesertaController::class,'biodata']);
        Route::post('peserta/biodata/simpan/{id}',[PesertaController::class,'store']);
    });

    Route::group(['middleware' => 'cek_login:admin'],function(){
        Route::get('admin/',[AdminController::class,'index']);
        
        Route::prefix('admin/artikel')->group(function(){
            Route::get('/',[ArtikelController::class,'index']); // ini sama dengan artikel/ method get
            Route::get('edit/{id}',[ArtikelController::class,'editForm']); // ini sama dengan artikel/ method get
            Route::get('hapus/{id}',[ArtikelController::class,'hapus'])->name('artikel.hapus'); // ini sama dengan artikel/hapus/{artikel_id} method get
            Route::get('tambah',[ArtikelController::class,'form']); // ini sama dengan artikel/ method post
            Route::post('tambah',[ArtikelController::class,'tambah']); // ini sama dengan artikel/ method post
            Route::post('edit/{id}',[ArtikelController::class,'edit'])->name('artikel.edit'); // ini sama dengan artikel/edit/{id_artikel} method post
        });
        Route::prefix('admin/peserta')->group(function(){
            Route::get('/',[AdminController::class,'peserta']);
            Route::get('edit/{id}',[AdminController::class,'pesertaEdit'])->name('adminpeserta.edit');
            Route::get('hapus/{id}',[AdminController::class,'pesertaHapus'])->name('adminpeserta.hapus');
            Route::get('biodata',[AdminController::class,'biodata'])->name('adminbio');
            // Route::get('biodata/edit/{id}',[AdminController::class,'biodataEdit'])->name('adminbio.edit');
            Route::get('biodata/hapus/{id}',[AdminController::class,'biodataHapus'])->name('adminbio.hapus');
            Route::post('edit/{id}',[AdminController::class,'editPeserta'])->name('peserta.edit'); // ini sama dengan artikel/edit/{id_artikel} method post
        });
    });
});