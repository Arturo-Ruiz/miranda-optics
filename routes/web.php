<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\CrystalController;
use App\Http\Controllers\MountController;   

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users management routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Patients management routes
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('/patients/{patient}/print', [PatientController::class, 'printFormula'])->name('patients.print');
    Route::get('/patients/{patient}/print-double', [PatientController::class, 'printFormulaDouble'])->name('patients.print-double');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

    // Crystals management routes
    Route::get('/crystals', [CrystalController::class, 'index'])->name('crystals.index');
    Route::post('/crystals', [CrystalController::class, 'store'])->name('crystals.store');
    Route::get('/crystals/{crystal}', [CrystalController::class, 'show'])->name('crystals.show');
    Route::put('/crystals/{crystal}', [CrystalController::class, 'update'])->name('crystals.update');
    Route::delete('/crystals/{crystal}', [CrystalController::class, 'destroy'])->name('crystals.destroy');

    //Mounts management routes
    Route::get('/mounts', [MountController::class, 'index'])->name('mounts.index');
    Route::post('/mounts', [MountController::class, 'store'])->name('mounts.store');
    Route::get('/mounts/{mount}', [MountController::class, 'show'])->name('mounts.show');
    Route::put('/mounts/{mount}', [MountController::class, 'update'])->name('mounts.update');
    Route::delete('/mounts/{mount}', [MountController::class, 'destroy'])->name('mounts.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
