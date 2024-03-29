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
use App\Http\Controllers\CompanyMatricsController;
use App\Http\Controllers\DataFieldCategoriesController;
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

Route::get('/asset/{:fund_id}/{:date}', [AssetController::class, 'index']);

Route::resource('fund', FundController::class);
Route::resource('fund/{fundFieldGroup}/field', FundFieldController::class)->only([
  'store', 'index'
]);
Route::resource('fund/field/group', FundFieldGroupController::class);
Route::resource('fund/field', FundFieldController::class)->only([
  'update', 'destroy'
]);

Route::resource('asset', AssetController::class);
Route::resource('asset/{assetFieldGroup}/field', AssetFieldController::class)->only([
  'store', 'index'
]);
Route::resource('asset/field/group', AssetFieldGroupController::class);
Route::resource('asset/field', AssetFieldController::class)->only([
  'update', 'destroy'
]);
Route::get('asset/{asset}/datacollection', [AssetController::class, 'datacollection']);
Route::resource('company/matrics', CompanyMatricsController::class);
Route::resource('asset/{asset}/matrics/category', DataFieldCategoriesController::class);

Route::resource('gl', GeneralLedgerController::class);