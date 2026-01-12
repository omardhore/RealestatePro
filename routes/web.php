<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

use App\Http\Controllers\PropertyController;

Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/create', [PropertyController::class, 'create'])->middleware(['auth', 'role:agent,admin'])->name('properties.create');
Route::post('/properties', [PropertyController::class, 'store'])->middleware(['auth', 'role:agent,admin'])->name('properties.store');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');

use App\Http\Controllers\KnowledgeBaseController;

Route::get('/knowledge-base', [KnowledgeBaseController::class, 'index'])->name('kb.index');
Route::get('/knowledge-base/{id}', [KnowledgeBaseController::class, 'show'])->name('kb.show');

use App\Http\Controllers\AdminController;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

    Route::get('/properties', [AdminController::class, 'properties'])->name('properties');
    Route::patch('/properties/{id}/approve', [AdminController::class, 'approveProperty'])->name('properties.approve');
    Route::patch('/properties/{id}/reject', [AdminController::class, 'rejectProperty'])->name('properties.reject');
    Route::delete('/properties/{id}', [AdminController::class, 'deleteProperty'])->name('properties.delete');
});
