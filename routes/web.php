<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PlantaApiController;
use App\Http\Controllers\PlantaController;
Auth::routes();

Route::get('/', [PlantaController::class,'index'])->name('plantas.index');
//function () {
//    return view('welcome');
//    return view('plantas.index');
//});


Route::prefix('api')->group(function () {
    Route::apiResource('plantas', PlantaApiController::class);
});


// Para Resource Controller (recomendado)
Route::resource('registros', 'App\Http\Controllers\RegistroController');
Route::get('/plantas/{id}/judit', [PlantaController::class, 'judit'])->name('plantas.judit');
//Route::get('/admin/planta/{id}',      [PlantaController::class, 'update'])->name('plantas.update');
//Route::put('/admin/planta/{id}',      [PlantaController::class, 'update'])->name('plantas.update');
Route::delete('/planta/{id}',         [PlantaController::class, 'destroy'])->name('plantas.destroy');

//Route::get('/plantas/',       [PlantaController::class, 'list'])->name('plantas.show');
Route::put('/plantas/{id}',      [PlantaController::class, 'update'])->name('plantas.update');


Route::resource('plantas', PlantaController::class);
//Route::get('plants/{plant}/qrcode',  [PlantaController::class, 'showQR'])->name('plants.qrcode');
//Route::get('planta/{plant}',       [PlantController::class, 'show'])->name('plantas.show');

//Route::post('/admin/planta',         [PlantaController::class, 'store'])->name('plantas.store');
//Route::get('/admin/planta',          [PlantaController::class,'show'])->name('plantas.show');;

//Route::get('photos/upload/{plant}', [PhotoController::class, 'showUploadForm'])->name('photos.upload');
//Route::post('photos/store',        [PhotoController::class, 'store'])->name('photos.store');
Route::get('/plantas/buscar',        [PlantaController::class, 'buscar'])->name('planta.buscar');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
