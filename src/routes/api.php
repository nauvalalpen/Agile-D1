<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
// import trackFacilityUsage.php
use App\Traits\TracksFacilityUsage;

Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard/realtime', [DashboardController::class, 'getRealTimeData']);
    Route::post('/facilities/{facility}/track-usage', [DashboardController::class, 'trackFacilityUsage']);
});