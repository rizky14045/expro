<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FaqController;
use App\Http\Controllers\User\LicenseController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ListWorkController;
use App\Http\Controllers\User\TrainingController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\EvaluationController;
use App\Http\Controllers\User\InspectionController;
use App\Http\Controllers\User\ChangePasswordController;

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
Route::prefix('user')->group(function () {

    Route::get('/faq', [FaqController::class, 'index'])->name('user.faq.index');
    Route::middleware(['auth'])->group(function () {
        Route::get('/home', [DashboardController::class, 'index'])->name('user.home.index');
        Route::get('/change-password', [ChangePasswordController::class, 'changePassword'])->name('user.changePassword');
        Route::patch('/update-password', [ChangePasswordController::class, 'updatePassword'])->name('user.updatePassword');
        Route::prefix('license')->group(function () {
            Route::get('/', [LicenseController::class, 'index'])->name('user.license.index');
            Route::get('/create', [LicenseController::class, 'create'])->name('user.license.create');
            Route::get('/edit', [LicenseController::class, 'edit'])->name('user.license.edit');
        });
        Route::prefix('inspection')->group(function () {
            Route::get('/', [InspectionController::class, 'index'])->name('user.inspection.index');
            Route::get('/create', [InspectionController::class, 'create'])->name('user.inspection.create');
            Route::get('/edit', [InspectionController::class, 'edit'])->name('user.inspection.edit');
        });
        Route::prefix('training')->group(function () {
            Route::get('/', [TrainingController::class, 'index'])->name('user.training.index');
            Route::get('/create', [TrainingController::class, 'create'])->name('user.training.create');
            Route::get('/edit', [TrainingController::class, 'edit'])->name('user.training.edit');
        });
    
        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('user.profile.index');
        });
        
    });
   
});