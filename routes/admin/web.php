<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InspectionController;
use App\Http\Controllers\Admin\ChangePasswordController;

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
    Route::get('/login', [AuthController::class, 'getLogin'])->name('admin.login')->middleware('guest-admin');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.getLogin')->middleware('guest-admin');
    
    Route::middleware(['auth-admin'])->group(function () { 
        Route::get('/change-password', [ChangePasswordController::class, 'changePassword'])->name('admin.changePassword');
        Route::patch('/update-password', [ChangePasswordController::class, 'updatePassword'])->name('admin.updatePassword');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/home', [DashboardController::class, 'index'])->name('admin.home.index');
        Route::prefix('license')->group(function () {
            Route::get('/', [LicenseController::class, 'index'])->name('admin.license.index');
            Route::get('/create', [LicenseController::class, 'create'])->name('admin.license.create');
            Route::get('/edit', [LicenseController::class, 'edit'])->name('admin.license.edit');
        });
        Route::prefix('inspection')->group(function () {
            Route::get('/', [InspectionController::class, 'index'])->name('admin.inspection.index');
            Route::get('/create', [InspectionController::class, 'create'])->name('admin.inspection.create');
            Route::post('/store', [InspectionController::class, 'store'])->name('admin.inspection.store');
            Route::get('/edit/{id}', [InspectionController::class, 'edit'])->name('admin.inspection.edit');
            Route::patch('/update/{id}', [InspectionController::class, 'update'])->name('admin.inspection.update');
            Route::get('/status-update/{id}', [InspectionController::class, 'statusUpdate'])->name('admin.inspection.statusUpdate');
            Route::patch('/status-update/{id}', [InspectionController::class, 'changeStatus'])->name('admin.inspection.changeStatus');
            Route::delete('/destroy/{id}', [InspectionController::class, 'destroy'])->name('admin.inspection.destroy');
        });
        Route::prefix('training')->group(function () {
            Route::get('/', [TrainingController::class, 'index'])->name('admin.training.index');
            Route::get('/create', [TrainingController::class, 'create'])->name('admin.training.create');
            Route::get('/edit', [TrainingController::class, 'edit'])->name('admin.training.edit');
        });

        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin.admin.index');
            Route::get('/create', [AdminController::class, 'create'])->name('admin.admin.create');
            Route::post('/store', [AdminController::class, 'store'])->name('admin.admin.store');
            Route::get('/show/{id}', [AdminController::class, 'show'])->name('admin.admin.show');
            Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
            Route::patch('/update/{id}', [AdminController::class, 'update'])->name('admin.admin.update');
            Route::delete('/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.admin.destroy');
        });

        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('/show/{id}', [UserController::class, 'show'])->name('admin.user.show');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        });
    });

});