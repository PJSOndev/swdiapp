<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SyncController;

// API route to sync data to Android App
Route::get('/sync-data', [SyncController::class, 'syncToAndroid']);
