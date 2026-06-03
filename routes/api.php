<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//GEOJSON API
Route ::get('/points', [App\Http\Controllers\ApiController::class, 'geojson_points'])
->name('geojson_points');

Route ::get('/point/{id}', [App\Http\Controllers\ApiController::class, 'geojson_point'])
->name('geojson_point');


//GEOJSON API
Route ::get('/polylines', [App\Http\Controllers\ApiController::class, 'geojson_polylines'])
->name('geojson_polylines');

Route ::get('/polyline/{id}', [App\Http\Controllers\ApiController::class, 'geojson_polyline'])
->name('geojson_polyline');



//GEOJSON API
Route ::get('/polygons', [App\Http\Controllers\ApiController::class, 'geojson_polygons'])
->name('geojson_polygons');

Route ::get('/polygon/{id}', [App\Http\Controllers\ApiController::class, 'geojson_polygon'])
->name('geojson_polygon');
