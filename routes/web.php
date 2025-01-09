<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\MembersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'Authlogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);


//Middleware Function for Admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    //Ministry Route
    Route::get('admin/ministry/list', [MinistryController::class, 'list']);
    Route::get('admin/ministry/add', [MinistryController::class, 'add']);
    Route::post('admin/ministry/add', [MinistryController::class, 'insert']);
    Route::get('admin/ministry/edit/{id}', [MinistryController::class, 'edit']);
    Route::post('admin/ministry/edit/{id}', [MinistryController::class, 'update']);
    Route::get('admin/ministry/delete/{id}', [MinistryController::class, 'delete']);

    //Change Password
    Route::get('admin/change_password', [PasswordController::class, 'change_password']);
    Route::post('admin/change_password', [PasswordController::class, 'update_change_password']);


    //Members List
    Route::get('admin/member/list', [MembersController::class, 'list']);
    Route::get('admin/member/add', [MembersController::class, 'add']);
    Route::post('admin/member/add', [MembersController::class, 'insert']);
});

//Middleware Function for User
Route::group(['middleware' => 'user'], function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard']);

    //Change Password
    Route::get('user/change_password', [PasswordController::class, 'change_password']);
    Route::post('user/change_password', [PasswordController::class, 'update_change_password']);
});
