<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PolicySelect;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\HolderController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\WithdrawController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function() {
    // Dashboard;
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    // User type;
    // Route::get('/type-of-holder', function() {
    //     return view('front.selection.holder');
    // })->name('holder.type');

    // Find user by phone;
    Route::get('/find-user-by-phone', function() {
        return view('front.holder.single.find');
    })->name('find.user.by.phone');

    // Policy Select;
    Route::get('/single-holder-policy', [PolicySelect::class, 'policy_select'])->name('holder.policy.select');
    Route::post('/policy/holder', [PolicySelect::class, 'show'])->name('holder.show.policy');


    // Holder route;
    Route::get('/holders', [HolderController::class, 'index'])->name('holder.index');
    Route::get('/holders/list', [HolderController::class, 'list'])->name('holder.list');
    Route::get('/holder/create', [HolderController::class, 'create'])->name('holder.create');
    Route::post('/holder/store', [HolderController::class, 'store'])->name('holder.store');
    Route::get('/holder/edit/{id}', [HolderController::class, 'edit'])->name('holder.edit');
    Route::post('/holder/update', [HolderController::class, 'update'])->name('holder.update');
    Route::get('/holder/delete/{id}', [HolderController::class, 'delete'])->name('holder.delete');

    // Holder info;
    Route::get('/policy/holder/{id}', [HolderController::class, 'show'])->name('holder.show');


    // Deposit route;
    Route::get('/deposit-date', [DepositController::class, 'deposit_date'])->name('deposit.date');
    Route::post('/deposit-date', [DepositController::class, 'deposit_date_check'])->name('deposit.date.check');
    Route::get('/deposit/policy-select', [DepositController::class, 'policy_select'])->name('deposit.policy.select');
    Route::post('/deposit/policy-select', [DepositController::class, 'policy_select_get'])->name('deposit.policy.select.get');
    Route::get('/deposit/money/create/{id}', [DepositController::class, 'add_money_create'])->name('deposit.money.create');
    Route::post('/deposit/money/sore/{id}', [DepositController::class, 'add_money_store'])->name('deposit.money.store');

    // Withdraw route;
    Route::get('/withdraw/select-policy', [WithdrawController::class, 'select_policy'])->name('withdraw.select.policy');
    Route::post('/withdraw/select-policy', [WithdrawController::class, 'select_policy_add'])->name('withdraw.select.policy.add');
    Route::get('/withdraw/check-ability/{id}', [WithdrawController::class, 'check_ability'])->name('withdraw.check.ability');
    Route::get('/withdraw/create/{id}', [WithdrawController::class, 'create'])->name('withdraw.create');
    Route::post('/withdraw/store/{id}', [WithdrawController::class, 'store'])->name('withdraw.store');

});

require __DIR__.'/auth.php';
