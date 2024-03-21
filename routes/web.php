<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananProyekController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;

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




Route::group(["middleware"=>'guest'],function (){
    
    //Route ke halaman login
    Route::get('/login',[AuthController::class,'getLogin'])->name('login-page');

    //Route ke halaman register
    Route::get('/register', function(){
        return view('Pages.register');
    });
    
    //Route post register
    Route::post('/register',[AuthController::class,'register'])->name('register');

    //Route untuk proses login
    Route::post('/login',[AuthController::class,'login'])->name('login');

});

Route::group(["middleware"=>['auth','ceklevel:admin']],function (){
    
    Route::group(["prefix"=>"/admin"], function() {

        //route kelola pengguna oleh admin
        Route::get('/users',[AuthController::class,'users'])->name('kelola_user');

        //route halaman update data users
        Route::get('/users/{uuid}',[AuthController::class,'get_user'])->name( 'update_data_user'); 
        
        //route simpan perubahan data user
        Route::post('/users/save/{id}', [AuthController::class, 'update_user'])->name('simpan_perubahan');
    });

    Route::group(['prefix'=>'/project/setting'],function(){

        //Route melihat kategori proyek oleh Admin
        Route::get('/',[ProjectController::class,'viewKatProyek'])->name('kategori');

        //Route menambahkan Kategori Proyek baru
        Route::post('/add', [ProjectController::class, 'addCatProyek'])->name('add.category.proj');

        //Route untuk pengaturan proyek  oleh admin
        Route::get('/{uuid}', [ProjectController::class, 'indexCatProyek'])->name('pengaturan_proyek');
        
        //Route mengedit dan merubah data kategori proyek
        Route::post('/{uuid}', [ProjectController::class, 'editCatProyek'])->name('edit.category.proj');

    });


});

Route::group(["middleware"=>['auth','ceklevel:admin,user']],function () {
    
    Route::get('/',  function () {
        return view('Pages.dashboard');
    });

    //Route ke halaman data customer
    Route::get('/customer',[CustomerController::class,'index'])->name('data_customer');

    //Route untuk logout
    Route::get("/logout", [AuthController::class, 'logout'])->name("logout");

    //Route group untuk manajamen proyek
    Route::group(['prefix' => '/order'], function(){

        //Route ke halaman list proyek pesanan
        Route::get('/',[PesananProyekController::class,'index'])->name( "list_pesanan" );

        //Route ke halaman  tambah project baru dari pelanggan
        Route::get('/add', [PesananProyekController::class, 'create_page'])->name('tambah_proyek');

        //Route simpan data project baru dari pelanggan
        Route::post('/store', [PesananProyekController::class, 'store'])->name('simpan_proyek');

        //Route menampilkan detail dari suatu project dari pelanggan
        Route::get('/{id}/detail', [PesananProyekController::class, 'show'])->name('lihat_detil_proyek');

        //Route untuk edit data Project dari pelanggan
        Route::get('/e/{id}', [PesananProyekController::class, 'edit'])->name('edit_proyek');

        //Route untuk mengirim permintaan edit data Project dari pelanggan
        Route::post('/update/{id}', [PesananProyekController::class, 'update'])->name('perbarui_proyek');

        //Route untuk hapus data Project  dari pelanggan
        Route::delete('/destroy/{id}', [PesananProyekController::class, 'destroy'])->name('hapus_proyek');

        //Route untuk update status proyek
        Route::get('/status/{status}/{id}', [PesananProyekController::class, 'update_status'])->name('ubah_status');

        //Route untuk riwayat pesanan
        Route::get('/riwayat',[PesananProyekController::class,"history"])->name('riwayat_proyek');
       
    });


});

