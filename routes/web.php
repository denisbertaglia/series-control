<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')
    ->group(function () {

        Route::prefix('profile')
            ->name('profile.')
            ->group(function () {
                Route::get('/', [ProfileController::class, 'edit'])->name('edit');
                Route::patch('/', [ProfileController::class, 'update'])->name('update');
                Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('series')
            ->group(function () {
                Route::get('/', [SeriesController::class, 'index'])->name('series.index');
                Route::get('/create', [SeriesController::class, 'create'])->name('series.create');
                Route::post('/store', [SeriesController::class, 'store'])->name('series.store');
                Route::delete('/{series}', [SeriesController::class, 'destroy'])->name('series.destroy');
                Route::get('/{series}/edit', [SeriesController::class, 'edit'])->name('series.edit');
                Route::patch('/{series}', [SeriesController::class, 'update'])->name('series.update');

                Route::get("{series}/seasons", [SeasonsController::class, 'index'])
                    ->name('seasons.index');
                Route::get("{series}/seasons/create", [SeasonsController::class, 'create'])
                    ->name('seasons.create');
                Route::put("{series}/seasons", [SeasonsController::class, 'update'])
                    ->name('seasons.update');
                Route::delete("{series}/seasons/{season}", [SeasonsController::class, 'delete'])
                    ->name('seasons.destroy');
            });
            
        Route::prefix('seasons')
            ->group(function () {
                Route::get("{season}/episodes", [EpisodeController::class, 'index'])
                    ->name('episodes.index');
                Route::get("{season}/episodes/create", [EpisodeController::class, 'create'])
                    ->name('episodes.create');
                Route::post("{season}/episodes", [EpisodeController::class, 'store'])
                    ->name('episodes.store');
                Route::put("{season}/episodes", [EpisodeController::class, 'update'])
                    ->name('episodes.update');
                Route::delete("{season}/episodes/{episode}", [EpisodeController::class, 'destroy'])
                    ->name('episodes.destroy');
            });
    });

require __DIR__ . '/auth.php';
