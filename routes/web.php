<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\DashboardController;
use App\Http\Controllers\Home\StatusMigrateController;
use App\Http\Controllers\InstallController;
use App\Http\Middleware\AuthMiddleware;
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

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'process_login'])->name('process_login');
Route::get('/install', [InstallController::class, 'install'])->name('lmd.install');
Route::post('/install_process', [InstallController::class, 'install_process'])->name('lmd.install_process');

Route::middleware([AuthMiddleware::class])->group(function(){
    Route::get('/home', [DashboardController::class, 'home'])->name('home.index');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::get('/status_migrate', [StatusMigrateController::class, 'index'])->name('status_migrate.index');
    Route::get('/status_migrate/{file_name}', [StatusMigrateController::class, 'show_file'])->name('status_migrate.show_file');
});