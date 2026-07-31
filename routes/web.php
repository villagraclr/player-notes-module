<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['web', 'auth'])->group(function (): void {
    Route::get('/players/{player}', [PlayerController::class, 'show'])
        ->name('players.show');
});
