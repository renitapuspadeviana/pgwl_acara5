<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolygonsController;
use App\Http\Controllers\PolylinesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [PageController::class, 'landingpage'])->name('home');

Route::get('/map', [PageController::class, 'map'])->
middleware(['auth', 'verified'])->
name('map');

Route::get('/table', [PageController::class, 'table'])->name('table');

Route::post('/store-points', [PointsController::class, 'store'])->name('points.store');

Route::post('/store-polylines', [PolylinesController::class, 'store'])->name('polylines.store');

Route::post('/store-polygons', [PolygonsController::class, 'store'])->name('polygons.store');

// Route untuk menghapus data titik berdasarkan ID
Route ::delete('/delete-points/{id}', [PointsController::class, 'destroy'])->name('points.delete');

// Route untuk mengedit data titik berdasarkan ID
Route ::get('/edit-point/{id}', [PointsController::class, 'edit'])->name('point.edit');

//Route untuk mengupdate data titik berdasarkan ID
Route ::patch('/update-point/{id}', [PointsController::class, 'update'])->name('point.update');

//Route untuk menghapus data garis berdasarkan ID
Route ::delete('/delete-polylines/{id}', [PolylinesController::class, 'destroy'])->name('polylines.delete');

// Route untuk mengedit data polyline berdasarkan ID
Route ::get('/edit-polyline/{id}', [PolylinesController::class, 'edit'])->name('polyline.edit');

//Route untuk mengupdate data polyline berdasarkan ID
Route ::patch('/update-polyline/{id}', [PolylinesController::class, 'update'])->name('polyline.update');

//Route untuk menghapus data polygon berdasarkan ID
Route ::delete('/delete-polygons/{id}', [PolygonsController::class, 'destroy'])->name('polygons.delete');

// Route untuk mengedit data polygon berdasarkan ID
Route ::get('/edit-polygon/{id}', [PolygonsController::class, 'edit'])->name('polygon.edit');

//Route untuk mengupdate data polygon berdasarkan ID
Route ::patch('/update-polygon/{id}', [PolygonsController::class, 'update'])->name('polygon.update');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';

