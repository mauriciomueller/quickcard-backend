<?php

use App\Http\Controllers\GenerateQRCodeImageController;
use App\Http\Controllers\UserQuickCardController;
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
Route::middleware(['api'])->prefix('v1')->group(function () {
    Route::post('/generate-qr-code-image', GenerateQRCodeImageController::class)
        ->name('generate_qr_code_image.store');

    Route::get('/user-quick-card/{slug}', UserQuickCardController::class)
        ->name('user_quick_card.index')
        ->where('slug', '[a-zA-Z0-9-_]+');;
});

