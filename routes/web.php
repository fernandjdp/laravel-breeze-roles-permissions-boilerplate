<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);

Route::resource('series', SerieController::class);
Route::resource('books', BookController::class);
Route::resource('movies', MovieController::class);

Route::resource('users', UserController::class);

Route::get('/users/{user}/permissions', [UserController::class, 'assignPermissions'])->name('users.permission');
Route::post('/users/{user}/permissions', [PermissionController::class, 'assignPermissions'])->name('permissions.user');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
