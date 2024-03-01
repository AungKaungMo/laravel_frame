<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\api\v1\auth\AuthController;
use App\Http\Controllers\Admin\api\v1\role\RoleController;
use App\Http\Controllers\Admin\api\v1\user\UserController;
use App\Http\Controllers\Admin\api\v1\permission\PermissionController;

Route::middleware(['auth:api'])->group(function () {
    // Role & Psermssions Management
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class)->except(['destroy']);
    Route::get('user_have_permissions', [PermissionController::class, 'userHavePermissions']);
    // User Management
    Route::apiResource('users', UserController::class);
    Route::delete('user_force_delete/{id}', [UserController::class, 'userForceDelete'])->name('user.force_delete');
    Route::post('user_return_reject/{id}', [UserController::class, 'userReturnReject'])->name('user.return_reject');
});

// Authentication Management
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('auth.logout');
