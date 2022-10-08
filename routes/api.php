<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YearController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\SuccursaleController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ScolariteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
   

    Route::group(['middleware' => ['auth:sanctum']], function () {
        //roles
        Route::apiResources(['roles'=>RoleController::class]); 
        //Users
        //Route::get('/users',[UserController::class,'index']);
        Route::apiResources(['users'=>UserController::class]);
        //Years
        Route::apiResources(['years'=>YearController::class]);

        Route::get('/authUser',[AuthController::class,'user']);
        Route::post('/logout',[AuthController::class,'logout']);
        /*********************************************************/
        Route::get("count",[YearController::class,'countData']);
        //cycles
        Route::apiResources(['cycles'=>CycleController::class]);
        //villes
        Route::apiResources(['villes'=>VilleController::class]);
        //succursales
        Route::apiResources(['succursales'=>SuccursaleController::class]);
        Route::get("succursalesVilles",[SuccursaleController::class,'villes']);
        Route::get("etudiantParSuccursale",[SuccursaleController::class,'nbrEtudiantParSuccursale']);
        //filieres
        Route::apiResources(['filieres'=>FiliereController::class]);
        Route::get("distinctFilieres",[FiliereController::class,'filieres']);
        Route::get("filiereCycleYear",[EtudiantController::class,'concatFiliere']);
        Route::get("distincSuccursales",[EtudiantController::class,'succursales']);
        Route::get("loadOnFiliereChange/{dev}/{Ann}/{Cyc}",[FiliereController::class,'onFiliereChange']);
        //loadOnFiliereChange
        //Etudiants
        Route::apiResources(['etudiants'=>EtudiantController::class]);
        Route::get("loadOnFilCycAnSuChange/{Fil}/{Cyc}/{Ann}/{Suc}",[EtudiantController::class,'onFilCycAnSuChange']);
        //scolarite
        Route::get("getEtudiantScolariteInformation/{id}",[ScolariteController::class,'getEtudiantScolariteInfo']);
        Route::post("payerScolariteEtudiant",[ScolariteController::class,'payerScolarite']);
    });

    Route::get('/hello',function(){
        return 'gonna kill you all';
    });





//Remember to put "\JWTAuth::setToken($token)->invalidate();" at logout(), otherwise the token is still valid even though you've logged out.

