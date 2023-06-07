<?php

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

Route::redirect('/', 'login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('/DataPasien', App\Http\Livewire\Admin\DataPasien\Index::class);
    Route::get('/RekamMedis', App\Http\Livewire\Admin\RekamMedis\Index::class);
    Route::get('/RiwayatPenyakit', App\Http\Livewire\Admin\RiwayatPenyakit\Index::class);
    Route::get('/Penyakit', App\Http\Livewire\Admin\Penyakit\Index::class);
    Route::get('/User', App\Http\Livewire\Admin\user\Index::class);

    Route::controller(App\Http\Controllers\Admin\RiwayatPenyakitController::class)->group(function (){
        // get detail riwayat penyakit
        Route::post('/riwayatDetail', [App\Http\Controllers\Admin\RiwayatPenyakitController::class, 'getDetailRiwayat']);
        // post data ke database
        Route::post('/penyakit/create', [App\Http\Controllers\Admin\RiwayatPenyakitController::class, 'store']);

    });

});


