<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
// Admin Controller
use App\Http\Controllers\admin\auth\AuthController;
use App\Http\Controllers\admin\dashboard\DashboardController;
use App\Http\Controllers\admin\role\RolesController;
use App\Http\Controllers\admin\permission\PermissionController;
use App\Http\Controllers\admin\user\UsersController;
use App\Http\Controllers\admin\user\ClientController;
use App\Http\Controllers\admin\sms\SmsController;
use App\Http\Controllers\admin\payment\PaymentController;
use App\Http\Controllers\admin\user\ClientNumberController;
use App\Http\Controllers\admin\user\SmsKeyController;
use App\Http\Controllers\admin\webhook\WebHookController;
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

// Main Page Route
Route::get('/', [HomePage::class, 'index'])->name('pages-home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::post('/get-mynumber', [DashboardController::class, 'getmymember'])->name('getmymember');

  Route::name('permission.')
    ->prefix('permission')
    ->group(function () {
      Route::get('/', [PermissionController::class, 'index'])->name('index');
      Route::get('/allpermission', [PermissionController::class, 'getallPermission'])->name('allpermission');
      Route::post('/store', [PermissionController::class, 'store'])->name('store');
      Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
      Route::post('/update', [PermissionController::class, 'update'])->name('update');
    });
  Route::name('role.')
    ->prefix('role')
    ->group(function () {
      Route::get('/', [RolesController::class, 'index'])->name('index');
      Route::get('/allpermission', [RolesController::class, 'getallPermission'])->name('allpermission');
      Route::post('/store', [RolesController::class, 'store'])->name('store');
      Route::get('/edit/{id}', [RolesController::class, 'edit'])->name('edit');
      Route::post('/update', [RolesController::class, 'update'])->name('update');
    });

  Route::name('client.')
    ->prefix('client')
    ->group(function () {
      Route::get('/', [ClientController::class, 'UserManagement'])->name('laravel-example-user-management');
      Route::resource('/client-list', ClientController::class);
    });
  Route::name('users.')
    ->prefix('users')
    ->group(function () {
      Route::get('/', [UsersController::class, 'UserManagement'])->name('laravel-example-user-management');
      Route::resource('/users-list', UsersController::class);
    });
  Route::name('sms_managment.')
    ->prefix('sms_managment')
    ->group(function () {
      Route::get('/', [SmsController::class, 'index'])->name('index');
      Route::get('/sendsms', [SmsController::class, 'sendMessage'])->name('sendsms');
      Route::post('/store', [SmsController::class, 'store'])->name('store');
      Route::post('/sendsms', [SmsController::class, 'sendsms'])->name('sendsms');
      Route::any('/sms-webhook', [SmsController::class, 'smsWehook'])->name('webhook.sms');
    });

  Route::name('payment.')
    ->prefix('payment')
    ->group(function () {
      Route::get('/', [PaymentController::class, 'index'])->name('index');
      Route::get('/add', [PaymentController::class, 'addAmount'])->name('addamount');
      Route::get('/addCard', [PaymentController::class, 'addCard'])->name('addCard');
      Route::post('/store', [PaymentController::class, 'store'])->name('store');
    });
  Route::name('client_number.')
    ->prefix('client_number')
    ->group(function () {
      Route::get('/', [ClientNumberController::class, 'index'])->name('index');
      Route::get('/add/{ID}', [ClientNumberController::class, 'add'])->name('add');
      Route::post('/store', [ClientNumberController::class, 'store'])->name('store');
      Route::post('/delete', [ClientNumberController::class, 'delete'])->name('delete');
      Route::post('/status', [ClientNumberController::class, 'status'])->name('status');
    });
  Route::name('sms_key.')
    ->prefix('sms_key')
    ->group(function () {
      Route::get('/{ID}', [SmsKeyController::class, 'index'])->name('index');
      Route::get('/add/{ID}', [SmsKeyController::class, 'add'])->name('add');
      Route::post('/store', [SmsKeyController::class, 'store'])->name('store');
      Route::get('/edit/{ID}', [SmsKeyController::class, 'edit'])->name('edit');
      Route::post('/update', [SmsKeyController::class, 'update'])->name('update');
      Route::post('/delete', [SmsKeyController::class, 'delete'])->name('delete');
      Route::post('/status', [SmsKeyController::class, 'status'])->name('status');
    });
});

Route::name('webhooks.')
  ->prefix('webhooks')
  ->group(function () {
    Route::get('/inbound-sms', [WebHookController::class, 'inboundSmsWehook'])->name('inboundSmsWehook');
    Route::get('/delivery-report-sms', [WebHookController::class, 'smsDeliveryReport'])->name('smsDeliveryReport');
    Route::get('/sms-webhook', [WebHookController::class, 'smsWehook'])->name('SmsWebhook');
  });
