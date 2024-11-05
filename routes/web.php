<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AdminFormController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//user form
Route::get('/', [FormController::class, 'userFormsIndex'])->name('userFormsIndex');
Route::post('/form/create', [FormController::class, 'FormCreate'])->name('FormCreate');

//register login
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('showRegisterForm');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// สำหรับ admin เท่านั้น
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/forms', [AdminFormController::class, 'adminshowform'])->name('adminshowform');
    Route::get('/admin/forms/{id}/edit', [AdminFormController::class, 'edit'])->name('show_form_edit');
    Route::put('/admin/forms/{id}', [AdminFormController::class, 'update'])->name('admin.forms.update');
    Route::get('/forms/export/{id}', [AdminFormController::class, 'exportPDF'])->name('exportPDF');
    Route::post('/forms/{id}/update-status', [AdminFormController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/admin/{form}/reply', [AdminFormController::class, 'reply'])->name('forms.reply');
});

// สำหรับ user เท่านั้น
Route::middleware(['user'])->group(function () {
    Route::get('/user/account/form', [UserAccountController::class, 'userAccountFormsIndex'])->name('userAccountFormsIndex');
    Route::get('/user/account/record', [UserAccountController::class, 'userRecordForm'])->name('userRecordForm');
    Route::get('/user/account/export/{id}', [UserAccountController::class, 'exportUserPDF'])->name('exportUserPDF');
    Route::get('/user/account/{id}/edit', [UserAccountController::class, 'userShowFormEdit'])->name('userShowFormEdit');
    Route::put('/user/account/{id}', [UserAccountController::class, 'updateUserForm'])->name('updateUserForm');
    Route::post('/user/account/{form}/reply', [UserAccountController::class, 'userReply'])->name('userReply');
});
