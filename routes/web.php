<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventsCalendarController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\AssignMinistryController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ResourcesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;

// Homepage route
Route::get('/', [WebsiteController::class, 'home'])->name('home');

// Ministry Page route
Route::get('/ministry', [WebsiteController::class, 'ministry'])->name('ministry');

// Events Page route
Route::get('/event', [WebsiteController::class, 'event'])->name('event');

// Resources Page route
Route::get('/resources-materials', [WebsiteController::class, 'materials'])->name('materials');


//Function for Login
Route::get('/admin', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'Authlogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);

// Middleware for Two-Factor Authentication
Route::group(['middleware' => 'auth', 'admin'], function () {
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
    Route::post('/two-factor/resend', [TwoFactorController::class, 'resend'])->name('two-factor.resend');
});

// Dashboard Routes for Admin 
Route::group(['middleware' => ['admin', 'twofactor']], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
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

    //Assign Ministry Route
    Route::get('admin/assign_ministry/list', [AssignMinistryController::class, 'list']);
    Route::get('admin/assign_ministry', [AssignMinistryController::class, 'assign']);
    Route::post('admin/assign_ministry', [AssignMinistryController::class, 'assigned']);
    Route::get('admin/assign_ministry/edit/{id}', [AssignMinistryController::class, 'edit']);
    Route::post('admin/assign_ministry/edit/{id}', [AssignMinistryController::class, 'update']);
    Route::get('admin/assign_ministry/delete/{id}', [AssignMinistryController::class, 'delete']);

    //Change Password
    Route::get('admin/change_password', [ProfileController::class, 'change_password']);
    Route::post('admin/change_password', [ProfileController::class, 'update_change_password']);

    Route::get('admin/profile', [ProfileController::class, 'MyProfile']);
    Route::post('admin/profile', [ProfileController::class, 'UpdateMyProfileAdmin']);
    Route::post('admin/profile/upload-image', [ProfileController::class, 'uploadProfileImage'])->name('upload-image');
    Route::delete('admin/profile/delete-image', [ProfileController::class, 'deleteProfileImage'])->name('delete-image');

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

    //Events Calendar V2
    Route::get('admin/events_calendar', [EventsCalendarController::class, 'EventsCalendar']);
    Route::get('/events', [EventsController::class, 'getEvents']);

    //Events List
    Route::get('admin/events/list', [EventsController::class, 'list']);
    Route::get('admin/events/add', [EventsController::class, 'add']);
    Route::post('admin/events/add', [EventsController::class, 'insert']);
    Route::get('admin/events/edit/{id}', [EventsController::class, 'edit']);
    Route::post('admin/events/edit/{id}', [EventsController::class, 'update']);
    Route::get('admin/events/delete/{id}', [EventsController::class, 'delete']);

    // Finance Tracker
    Route::get('admin/finance/list', [FinanceController::class, 'list'])->name('finance.list');
    Route::post('/admin/finance/add', [FinanceController::class, 'addFinance'])->name('finance.addFinance');
    Route::get('admin/finance/add', [FinanceController::class, 'add'])->name('finance.add');
    Route::get('/admin/finance/edit/{id}', [FinanceController::class, 'edit'])->name('finance.edit');
    Route::put('/admin/finance/update/{id}', [FinanceController::class, 'update'])->name('finance.update');
    Route::get('/admin/finance/receipt/view/{id}', [FinanceController::class, 'viewReceipt'])->name('finance.receipt.view');
    Route::get('/admin/finance/receipt/download/{id}', [FinanceController::class, 'downloadReceipt'])->name('finance.receipt.download');
    Route::get('/admin/finance/member-report', [FinanceController::class, 'memberReport'])->name('finance.memberReport');
    Route::get('/admin/finance/member-report/pdf', [FinanceController::class, 'exportMemberReportPDF'])->name('finance.memberReport.pdf');


    //Church Resources Route
    Route::get('admin/church_resources/list', [ResourcesController::class, 'list']);
    Route::get('admin/church_resources/add', [ResourcesController::class, 'add']);
    Route::post('admin/church_resources/add', [ResourcesController::class, 'insert']);
    Route::get('admin/church_resources/edit/{id}', [ResourcesController::class, 'edit']);
    Route::post('admin/church_resources/edit/{id}', [ResourcesController::class, 'update']);
    Route::get('admin/church_resources/delete/{id}', [ResourcesController::class, 'delete']);

    //Archived Members
    Route::get('admin/archived/members', [MembersController::class, 'archived']);
    Route::get('admin/archived/restore/member/{id}', [MembersController::class, 'restore']);
    Route::get('admin/archived/delete/member/{id}', [MembersController::class, 'deleteArchived']);

    //Archived Church Resources
    Route::get('admin/archived/church_resources', [ResourcesController::class, 'archived']);
    Route::get('admin/archived/restore/{id}', [ResourcesController::class, 'restore']);
    Route::get('admin/archived/delete/{id}', [ResourcesController::class, 'deleteArchived']);
});

// Dashboard Routes for Users
Route::group(['middleware' => ['user', 'twofactor']], function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');

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

    //User Events 
    Route::get('user/events/list', [EventsController::class, 'list']);
    Route::get('user/events/add', [EventsController::class, 'add']);
    Route::post('user/events/add', [EventsController::class, 'insert']);
    Route::get('user/events/edit/{id}', [EventsController::class, 'edit']);
    Route::post('user/events/edit/{id}', [EventsController::class, 'update']);
    Route::get('user/events/delete/{id}', [EventsController::class, 'delete']);

    Route::get('user/events_calendar', [EventsCalendarController::class, 'EventsCalendar']);
    Route::get('/events', [EventsController::class, 'getEvents']);

    //Ministry Route
    Route::get('user/ministry/list', [MinistryController::class, 'list']);
    Route::get('user/ministry/add', [MinistryController::class, 'add']);
    Route::post('user/ministry/add', [MinistryController::class, 'insert']);
    Route::get('user/ministry/edit/{id}', [MinistryController::class, 'edit']);
    Route::post('user/ministry/edit/{id}', [MinistryController::class, 'update']);
    Route::get('user/ministry/delete/{id}', [MinistryController::class, 'delete']);

    //Assign Ministry Route
    Route::get('user/assign_ministry/list', [AssignMinistryController::class, 'list']);
    Route::get('user/assign_ministry', [AssignMinistryController::class, 'assign']);
    Route::post('user/assign_ministry', [AssignMinistryController::class, 'assigned']);
    Route::get('user/assign_ministry/edit/{id}', [AssignMinistryController::class, 'edit']);
    Route::post('user/assign_ministry/edit/{id}', [AssignMinistryController::class, 'update']);
    Route::get('user/assign_ministry/delete/{id}', [AssignMinistryController::class, 'delete']);

    //Announcement
    Route::get('user/announcements', [AnnouncementController::class, 'Announcement']);
    Route::get('user/announcements/create_announcement/add', [AnnouncementController::class, 'AddAnnouncement']);
    Route::post('user/announcements/create_announcement/add', [AnnouncementController::class, 'InsertAnnouncement']);
    Route::get('user/announcements/create_announcement/edit/{id}', [AnnouncementController::class, 'EditAnnouncement']);
    Route::post('user/announcements/create_announcement/edit/{id}', [AnnouncementController::class, 'UpdateAnnouncement']);
    Route::get('user/announcements/create_announcement/delete/{id}', [AnnouncementController::class, 'DeleteAnnouncement']);

    //Send Announcements
    Route::get('user/send_announcements', [AnnouncementController::class, 'SendAnnouncement']);
    Route::post('user/send_announcements', [AnnouncementController::class, 'SendAnnouncementUser']);

    //Church Resources Route
    Route::get('user/church_resources/list', [ResourcesController::class, 'list']);
    Route::get('user/church_resources/add', [ResourcesController::class, 'add']);
    Route::post('user/church_resources/add', [ResourcesController::class, 'insert']);
    Route::get('user/church_resources/edit/{id}', [ResourcesController::class, 'edit'])->name('resources.edit');
    Route::post('user/church_resources/edit/{id}', [ResourcesController::class, 'update']);
    Route::get('user/church_resources/delete/{id}', [ResourcesController::class, 'delete']);
});
