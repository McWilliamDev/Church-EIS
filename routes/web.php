<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('website.homepage');
});

//Function for Login
Route::get('/admin', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'Authlogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);

// Middleware for Two-Factor Authentication
Route::group(['middleware' => 'admin'], function () {
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
});

// Dashboard Routes
Route::group(['middleware' => ['admin', 'twofactor']], function () {
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
    Route::get('admin/change_password', [ProfileController::class, 'change_password']);
    Route::post('admin/change_password', [ProfileController::class, 'update_change_password']);

    Route::get('admin/profile', [ProfileController::class, 'MyProfile']);
    Route::post('admin/profile', [ProfileController::class, 'UpdateMyProfileAdmin']);

    //Users List
    Route::get('admin/user/list', [UserController::class, 'list']);
    Route::get('admin/user/add', [UserController::class, 'add']);
    Route::post('admin/user/add', [UserController::class, 'insert']);
    Route::get('admin/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('admin/user/edit/{id}', [UserController::class, 'update']);
    Route::get('admin/user/delete/{id}', [UserController::class, 'delete']);

    //Members List
    Route::get('admin/member/list', [MembersController::class, 'list']);
    Route::get('admin/member/add', [MembersController::class, 'add']);
    Route::post('admin/member/add', [MembersController::class, 'insert']);
    Route::get('admin/member/edit/{id}', [MembersController::class, 'edit']);
    Route::post('admin/member/edit/{id}', [MembersController::class, 'update']);
    Route::get('admin/member/delete/{id}', [MembersController::class, 'delete']);

    //Announcement
    Route::get('admin/announcements', [AnnouncementController::class, 'Announcement']);
    Route::get('admin/announcements/create_announcement/add', [AnnouncementController::class, 'AddAnnouncement']);
    Route::post('admin/announcements/create_announcement/add', [AnnouncementController::class, 'InsertAnnouncement']);
    Route::get('admin/announcements/create_announcement/edit/{id}', [AnnouncementController::class, 'EditAnnouncement']);
    Route::post('admin/announcements/create_announcement/edit/{id}', [AnnouncementController::class, 'UpdateAnnouncement']);
    Route::get('admin/announcements/create_announcement/delete/{id}', [AnnouncementController::class, 'DeleteAnnouncement']);

    //Send Announcements
    Route::get('admin/send_announcements', [AnnouncementController::class, 'SendAnnouncement']);
    Route::post('admin/send_announcements', [AnnouncementController::class, 'SendAnnouncementUser']);

    Route::get('admin/announcements/search_users', [AnnouncementController::class, 'SearchUser']);

    //Events Calendar
    Route::get('admin/events/calendar', [EventController::class, 'index']);
    Route::post('admin/events/calendar', [EventController::class, 'store'])->name('calendar.store');
    Route::patch('admin/events/calendar/update/{id}', [EventController::class, 'update'])->name('calendar.update');
    Route::delete('admin/events/calendar/destroy/{id}', [EventController::class, 'destroy'])->name('calendar.destroy');

    //Events List
    Route::get('admin/events/list', [EventsController::class, 'list']);
    Route::get('admin/events/add', [EventsController::class, 'add']);
    Route::post('admin/events/add', [EventsController::class, 'insert']);
    Route::get('admin/events/edit/{id}', [EventsController::class, 'edit']);
    Route::post('admin/events/edit/{id}', [EventsController::class, 'update']);
    Route::get('admin/events/delete/{id}', [EventsController::class, 'delete']);
});

//Middleware Function for User
Route::group(['middleware' => 'user'], function () {
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
});

// Dashboard Routes
Route::group(['middleware' => ['user', 'twofactor']], function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard']);

    //Change Password
    Route::get('user/change_password', [ProfileController::class, 'change_password']);
    Route::post('user/change_password', [ProfileController::class, 'update_change_password']);

    Route::get('user/profile', [ProfileController::class, 'MyProfile']);
    Route::post('user/profile', [ProfileController::class, 'UpdateMyProfile']);

    //User Member List
    Route::get('user/member/list', [MembersController::class, 'list']);
    Route::get('user/member/add', [MembersController::class, 'add']);
    Route::post('user/member/add', [MembersController::class, 'insert']);
    Route::get('user/member/edit/{id}', [MembersController::class, 'edit']);
    Route::post('user/member/edit/{id}', [MembersController::class, 'update']);
    Route::get('user/member/delete/{id}', [MembersController::class, 'delete']);

    //User Ministry 
    Route::get('user/ministry/list', [MinistryController::class, 'list']);
    Route::get('user/ministry/add', [MinistryController::class, 'add']);
    Route::post('user/ministry/add', [MinistryController::class, 'insert']);
    Route::get('user/ministry/edit/{id}', [MinistryController::class, 'edit']);
    Route::post('user/ministry/edit/{id}', [MinistryController::class, 'update']);
    Route::get('user/ministry/delete/{id}', [MinistryController::class, 'delete']);
});
