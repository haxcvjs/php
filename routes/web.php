<?php

use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\Connection;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\VIPController;
use App\Http\Controllers\WithdrawController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\DashboardMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Models\System;
use Core\Facades\Route;
use Core\Http\Request;
use Core\Tools\Cookie;

session_start();

app()->instance('app.system' , (new System)->get());

 

Route::get('/test', function() : void {
   Cookie::set('ids' , 543, time()+60*60, '/' , 'localhost' , true, true);
});


Route::get('/', [DashboardController::class])->middleware(DashboardMiddleware::class)->name('dashboard');
Route::get('/dashboard', [DashboardController::class])->middleware(DashboardMiddleware::class)->name('dashboard.home');
Route::get('/dashboard/mission', [MissionController::class])->middleware(DashboardMiddleware::class)->name('dashboard.mission');
Route::get('/dashboard/vip', [VIPController::class])->middleware(DashboardMiddleware::class)->name('dashboard.vip');
Route::get('/dashboard/balance', [PaymentsController::class, 'payments'])->middleware(DashboardMiddleware::class)->name('dashboard.balance');
Route::get('/dashboard/team', [PaymentsController::class, 'team'])->middleware(DashboardMiddleware::class)->name('dashboard.team');
Route::get('/dashboard/withdraw', [WithdrawController::class])->middleware(DashboardMiddleware::class)->name('dashboard.withdraw');
Route::get('/dashboard/deposit', [DepositController::class])->middleware(DashboardMiddleware::class)->name('dashboard.deposit');
Route::get('/dashboard/payments', [PaymentsController::class])->middleware(DashboardMiddleware::class)->name('dashboard.payments');
Route::get('/dashboard/support', [SupportController::class])->middleware(DashboardMiddleware::class)->name('dashboard.support');
Route::get('/dashboard/settings', [AccountController::class, 'settings'])->middleware(DashboardMiddleware::class)->name('dashboard.settings');
Route::get('/dashboard/notifications', [DashboardController::class, 'notifications'])->middleware(DashboardMiddleware::class)->name('dashboard.notifications');

Route::post('/dashboard/settings/change-info', [AccountController::class, 'updateInfo'])->middleware(DashboardMiddleware::class)->name('dashboard.settings.info');
Route::post('/dashboard/settings/change-password', [AccountController::class, 'updatePassword'])->middleware(DashboardMiddleware::class)->name('dashboard.settings.changepassword');

Route::post('/connect/notifications', [Connection::class, 'notification'])->middleware(DashboardMiddleware::class)->name('connect.sync');
Route::post('/connect/seen', [Connection::class, 'seen'])->middleware(DashboardMiddleware::class)->name('connect.seen');
Route::post('/connect/read/{ID}', [Connection::class, 'read'])->middleware(DashboardMiddleware::class);
Route::post('/connect/read', [Connection::class, 'read'])->middleware(DashboardMiddleware::class)->name('connect.read');

Route::post('/dashboard/deposit/verify', [DepositController::class, 'verify'])->middleware(DashboardMiddleware::class)->name('dashboard.deposit.verify');

Route::get('/login', [AccountController::class])->middleware(LoginMiddleware::class)->name('auth.login');
Route::post('/login', [AccountController::class, 'login'])->middleware(AuthMiddleware::class);

Route::get('/signup/{code}', [AccountController::class, 'signup2'])->middleware(LoginMiddleware::class);
Route::get('/signup', [AccountController::class, 'signup'])->middleware(LoginMiddleware::class)->name('auth.signup');
Route::post('/signup', [AccountController::class, 'register'])->middleware(AuthMiddleware::class);

Route::post('/recovery', [AccountController::class, 'recover'])->middleware(AuthMiddleware::class);
Route::get('/recovery', [AccountController::class, 'recover'])->name('auth.recovery');

Route::post('/reset', [AccountController::class, 'reset'])->middleware(AuthMiddleware::class);
Route::get('/reset/{code}', [AccountController::class, 'reset'])->name('auth.reset');

Route::post('/subscribe', [VIPController::class, 'subscribe'])->middleware(AuthMiddleware::class)->name('dashboard.subscribe');


Route::post('/dotask', [MissionController::class, 'doTask'])->middleware(AuthMiddleware::class)->name('dashboard.doTask');

Route::post('/dashboard/withdraw', [PaymentsController::class, 'withdraw'])->middleware(AuthMiddleware::class)->name('dashboard.withdraw');


Route::get('/facker-recharge/{Address}/{amount}', function ($Address, $amount) {

   $FakerFile = app()->basePath . '/app/Providers/web3Providers/FackerTatumTransication.json';
   $Transactions = json_decode(file_get_contents($FakerFile));

   if (!is_object($Transactions)) return (object) [];
   if (!property_exists($Transactions, $Address)) {
      $Transactions->{$Address} =  [
         'address' => $Address,
         'data' => [
            'fromAddress' => 'T' . str_shuffle('Fr6qLuKTdRJ8YreanS651xtZUJcikXUus'),
            'amount' => (float) $amount,
            'time' => time()
         ]
      ];
   } else { 

      if(!is_array($Transactions->{$Address}->data)) {
         $Transactions->{$Address}->data = [];
      }
      $Transactions->{$Address}->data[] =  [
         'fromAddress' => 'T' . str_shuffle('Fr6qLuKTdRJ8YreanS651xtZUJcikXUus'),
         'amount' => (float) $amount,
         'time' => time()
      ];
   }
   file_put_contents($FakerFile, json_encode($Transactions));
});






Route::get('/logout', function () {
   app(AccountController::class)->destroySession();
   redirect(route('dashboard.home'));
   123;
})->name('logout');



 