<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\HomeController;

// Home routes
Route::middleware('auth')->get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->get('/', [HomeController::class, 'index'])->name('welcome');

// Authentication Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes for all authenticated users
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Annonces routes
    Route::get('annonces', [AnnonceController::class, 'index'])->name('annonces.index');
    Route::get('annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
    Route::post('annonces', [AnnonceController::class, 'store'])->name('annonces.store');
    Route::get('annonces/{annonce}', [AnnonceController::class, 'show'])->name('annonces.show');
    Route::get('annonces/{annonce}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
    Route::put('annonces/{annonce}', [AnnonceController::class, 'update'])->name('annonces.update');
    Route::delete('annonces/{annonce}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');

    // Messages routes
    Route::resource('messages', MessageController::class);
});

// Admin only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategorieController::class);
    Route::get('admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::resource('administrateurs', AdministrateurController::class);
});