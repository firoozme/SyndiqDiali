<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\FeeController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\CashController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\ChargeController;
use App\Http\Controllers\api\v1\DocumentController;
use App\Http\Controllers\api\v1\ResidentController;
use App\Http\Controllers\api\v1\SyndicateController;
use App\Http\Controllers\api\v1\historyLogController;
use App\Http\Controllers\api\v1\bankAccountController;
use App\Http\Controllers\api\v1\companyChargeController;

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

Route::prefix('v1')->group(function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forget', [AuthController::class, 'forget']);
    Route::post('/reset', [AuthController::class, 'reset']);

    Route::middleware('auth:api')->group(function(){

        //Logout
        Route::post('/logout', [AuthController::class, 'logout']);
    
        // User
        Route::apiResource('user',UserController::class);

        // Syndicate
        Route::apiResource('syndicate',SyndicateController::class);
        
        // Resident
        Route::apiResource('resident',ResidentController::class);
        
        // Fee
        Route::apiResource('fee',FeeController::class);

        // Document
        Route::apiResource('document',DocumentController::class);
        
        // Bank Account
        Route::apiResource('bankAccount',bankAccountController::class);

        // Cash
        Route::apiResource('cash',CashController::class);
        
        // Charge
        Route::apiResource('charge',ChargeController::class);

        // Company Charges
        Route::apiResource('companyCharge',companyChargeController::class);

        // History Logs
        Route::get('historyLogs',[historyLogController::class, 'index']);

    });
});
