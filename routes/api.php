<?php

use App\Http\Controllers\Api\GlossarioController;
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

Route::apiResource('words', GlossarioController::class)->only('index');
Route::get('words/{id}', [GlossarioController::class, 'show']);
