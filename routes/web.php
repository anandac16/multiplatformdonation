<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\OverlayController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/monitor', [MonitorController::class, 'index'])->name('admin.monitor');
});

// // Widget routes (no auth)
// Route::get('widget/milestone/{id}', [MilestoneController::class, 'widget'])->name('milestone.widget');
// Route::get('widget/leaderboard/{id}', [LeaderboardController::class, 'widget'])->name('leaderboard.widget');

Route::get('/', [HomeController::class, 'dashboard'])->name('index');
Route::post('/check-uuid', [HomeController::class, 'checkUuid'])->name('check.uuid');
Route::get('/tokens', [TokenController::class, 'index'])->name('tokens.index');
Route::post('/tokens', [TokenController::class, 'store'])->name('tokens.store');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/howto', [HomeController::class, 'howto'])->name('howto');
Route::get('/connect', [HomeController::class, 'index'])->name('connect');

Route::middleware(['check.uuid'])->group(function () {

    Route::get('/tokens/{uuid}', [TokenController::class, 'index'])->name('tokens.show');
    Route::post('/tokens/{uuid}', [TokenController::class, 'update'])->name('tokens.update');

    // Overlay settings
    Route::get('/overlays/milestone', [OverlayController::class, 'editMilestone'])->name('overlay.milestone.edit');
    Route::post('/overlays/milestone', [OverlayController::class, 'updateMilestone'])->name('overlay.milestone.update');

    Route::get('/overlays/leaderboard', [OverlayController::class, 'editLeaderboard'])->name('overlay.leaderboard.edit');
    Route::post('/overlays/leaderboard', [OverlayController::class, 'updateLeaderboard'])->name('overlay.leaderboard.update');

    // Donation history
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');

});

// OBS Widgets (no middleware)
Route::get('/widget/milestone/{uuid}', [WidgetController::class, 'milestone'])->name('widget.milestone');
Route::get('/widget/leaderboard/{uuid}', [WidgetController::class, 'leaderboard'])->name('widget.leaderboard');