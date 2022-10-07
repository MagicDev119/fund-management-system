<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\FundFieldController;
use App\Http\Controllers\FundFieldGroupController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetFieldController;
use App\Http\Controllers\AssetFieldGroupController;
use App\Http\Controllers\GeneralLedgerController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);
    });
});

Route::resource('fund', FundController::class);
Route::resource('fund/field', FundFieldController::class);
Route::resource('fund/field/group', FundFieldGroupController::class);

Route::resource('asset', AssetController::class);
Route::resource('asset/field', AssetFieldController::class);
Route::resource('asset/field/group', AssetFieldGroupController::class);

Route::resource('gl', GeneralLedgerController::class);