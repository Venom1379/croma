<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleCertificateController;
use App\Http\Controllers\CompanyController;


require __DIR__ . '/auth.php';

// Route::get('/', function () {
//     echo 'hello';
// })->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('supervisors')->group(function () {

        Route::get('/', [SupervisorController::class, 'index'])->name('supervisors.index');

        Route::get('/datatable', [SupervisorController::class, 'datatable'])->name('supervisors.datatable');

        Route::get('/create', [SupervisorController::class, 'create'])->name('supervisors.create');

        Route::post('/store', [SupervisorController::class, 'store'])->name('supervisors.store');

        Route::get('/show/{id}', [SupervisorController::class, 'show'])->name('supervisors.show');

        Route::get('/edit/{id}', [SupervisorController::class, 'edit'])->name('supervisors.edit');

        Route::post('/update/{id}', [SupervisorController::class, 'update'])->name('supervisors.update');

        Route::get('/delete/{id}', [SupervisorController::class, 'destroy'])->name('supervisors.destroy');
        Route::get('/status/{id}', [SupervisorController::class, 'toggleStatus'])->name('supervisors.status');
    });
    Route::get('certificates', [VehicleCertificateController::class, 'index'])->name('certificates.index');

    Route::get('certificates/datatable', [VehicleCertificateController::class, 'datatable'])->name('certificates.datatable');

    Route::get('certificates/create', [VehicleCertificateController::class, 'create'])->name('certificates.create');

    Route::post('certificates/store', [VehicleCertificateController::class, 'store'])->name('certificates.store');

    Route::get('certificates/edit/{id}', [VehicleCertificateController::class, 'edit'])->name('certificates.edit');

    Route::post('certificates/update/{id}', [VehicleCertificateController::class, 'update'])->name('certificates.update');

    Route::get('certificates/delete/{id}', [VehicleCertificateController::class, 'destroy'])->name('certificates.destroy');

    Route::get('certificates/approve/{id}', [VehicleCertificateController::class, 'approve'])->name('certificates.approve');

    Route::get('certificates/reject/{id}', [VehicleCertificateController::class, 'reject'])->name('certificates.reject');
    Route::get('certificates/download/{id}', [VehicleCertificateController::class, 'download'])
    ->name('certificates.download');
    Route::prefix('companies')->name('companies.')->group(function () {

        Route::get('/', [CompanyController::class, 'index'])->name('index');

        Route::get('/datatable', [CompanyController::class, 'datatable'])->name('datatable');

        Route::post('/store', [CompanyController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('edit');

        Route::put('/update/{id}', [CompanyController::class, 'update'])->name('update');

        Route::delete('/delete/{id}', [CompanyController::class, 'destroy'])->name('destroy');
    });
});
