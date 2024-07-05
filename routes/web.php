<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/user', [TransactionController::class, 'index'])->name('transactions');

// Routes for individual users
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transactions');
    Route::get('/deposit', [TransactionController::class, 'deposits'])->name('deposits');
    Route::post('/deposit', [TransactionController::class, 'deposit'])->name('deposit');
    Route::get('/withdrawal', [TransactionController::class, 'withdrawals'])->name('withdrawals');
    Route::post('/withdrawal', [TransactionController::class, 'withdraw'])->name('withdraw');

    Route::get('/deposit-form', function () {
        return view('transactions.deposit_form');
    })->name('deposit-form');

    Route::get('/withdraw-form', function () {
        return view('transactions.withdraw_form');
    })->name('withdraw-form');

});
