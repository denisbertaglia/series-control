<?php

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
            ->name('series.')
            ->group(function () {
                Route::get('/', [SeriesController::class, 'index'])->name('index');
                Route::get('/create', [SeriesController::class, 'create'])->name('create');
                Route::post('/store', [SeriesController::class, 'store'])->name('store');
                Route::delete('/{series}', [SeriesController::class, 'destroy'])->name('destroy');
                Route::get('/{series}/edit', [SeriesController::class, 'edit'])->name('edit');
                Route::patch('/{series}', [SeriesController::class, 'update'])->name('update');

                Route::get("{series}/seasons", [SeasonsController::class, 'index'])
                    ->name('seasons.index');
                Route::get("{series}/seasons/create", [SeasonsController::class, 'create'])
                    ->name('seasons.create');
                Route::put("{series}/seasons", [SeasonsController::class, 'update'])
                    ->name('seasons.update');
                Route::delete("{series}/seasons/{season}", [SeasonsController::class, 'delete'])
                    ->name('seasons.delete');
            });
    });

require __DIR__ . '/auth.php';
