<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\AuthController;

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
    return redirect()->route('login');
});

Route::get('/scanner/{uuid}', [HomeController::class, 'scanner'])->name('scanner');
Route::get('/result-scanner/{uuid}', [HomeController::class, 'resultScanner'])->name('resultScanner');
Route::post('/input-scanner/{uuid}', [HomeController::class, 'inputScanner'])->name('inputScanner');
Route::get('/tester', [HomeController::class, 'tester'])->name('tester');
Route::get('/login', [AuthController::class, 'getLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('getLogin')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

require_once('user/web.php');
require_once('admin/web.php');