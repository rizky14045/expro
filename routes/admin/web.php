<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ListWorkController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\InspectionController;
use App\Http\Controllers\Admin\PraqualificationController;

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
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('admin.login');
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.home.index');
    Route::get('/faq', [FaqController::class, 'index'])->name('admin.faq.index');

    Route::prefix('license')->group(function () {
        Route::get('/', [LicenseController::class, 'index'])->name('admin.license.index');
        Route::get('/create', [LicenseController::class, 'create'])->name('admin.license.create');
        Route::get('/edit', [LicenseController::class, 'edit'])->name('admin.license.edit');
    });
    Route::prefix('inspection')->group(function () {
        Route::get('/', [InspectionController::class, 'index'])->name('admin.inspection.index');
        Route::get('/create', [InspectionController::class, 'create'])->name('admin.inspection.create');
        Route::get('/edit', [InspectionController::class, 'edit'])->name('admin.inspection.edit');
    });
    Route::prefix('training')->group(function () {
        Route::get('/', [TrainingController::class, 'index'])->name('admin.training.index');
        Route::get('/create', [TrainingController::class, 'create'])->name('admin.training.create');
        Route::get('/edit', [TrainingController::class, 'edit'])->name('admin.training.edit');
    });
    
    Route::prefix('faq')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('admin.faq.index');
        Route::get('/create', [FaqController::class, 'create'])->name('admin.faq.create');
        Route::get('/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
    });
});