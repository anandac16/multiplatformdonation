<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\WidgetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tokens/{uuid}', [TokenController::class, 'jsonData'])
    ->middleware('verify.vps.secret');

Route::post('/donations', [DonationController::class, 'storeJson'])
    ->middleware('verify.vps.secret');

Route::get('/widgets/milestone/{uuid}', [WidgetController::class, 'milestoneJson'])
    ->middleware('verify.vps.secret');

Route::get('/widgets/leaderboard/{uuid}', [WidgetController::class, 'leaderboardJson'])
    ->middleware('verify.vps.secret');