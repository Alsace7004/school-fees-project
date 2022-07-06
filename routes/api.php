<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YearController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\SuccursaleController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\EtudiantController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['years'=>YearController::class]);
Route::apiResources(['cycles'=>CycleController::class]);
Route::apiResources(['villes'=>VilleController::class]);
Route::apiResources(['succursales'=>SuccursaleController::class]);
Route::get("succursalesVilles",[SuccursaleController::class,'villes']);
Route::apiResources(['filieres'=>FiliereController::class]);
Route::get("distinctFilieres",[FiliereController::class,'filieres']);
Route::get("filiereCycleYear",[EtudiantController::class,'concatFiliere']);
Route::get("distincSuccursales",[EtudiantController::class,'succursales']);
Route::get("loadOnFiliereChange/{dev}/{Ann?}/{Cyc?}",[FiliereController::class,'onFiliereChange']);
//loadOnFiliereChange
//Etudiants
Route::apiResources(['etudiants'=>EtudiantController::class]);
