<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PolicySelect;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\HolderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\SelectDateController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PdfDownloadController;
use App\Http\Controllers\UserController;

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


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Login;
Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});


Route::middleware(['auth'])->group(function() {
    // Dashboard;
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    // Logout;
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Find user by phone or ID;
    Route::get('/find-user-by-phone', function() {
        return view('front.holder.single.find');
    })->name('find.user.by.phone');

    // Custom 404;
    Route::get('/not-allowed', function() {
        return view('front.custom404');
    })->name('custom.404');

    // Policy Select;
    Route::get('/single-holder-policy', [PolicySelect::class, 'policy_select'])->name('holder.policy.select');
    Route::post('/policy/holder', [PolicySelect::class, 'show'])->name('holder.show.policy');

    // Date select;
    Route::get('/select-date/{page}', [SelectDateController::class, 'select'])->name('date.select');
    Route::post('/select-date', [SelectDateController::class, 'store'])->name('date.store');


    /*
    |--------------------------------------------------------------------------
    | Holder Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::middleware(['admin'])->group(function() {
        Route::get('/holders', [HolderController::class, 'index'])->name('holder.index');
        Route::get('/holders/list', [HolderController::class, 'list'])->name('holder.list');
        Route::get('/holder/create', [HolderController::class, 'create'])->name('holder.create');
        Route::post('/holder/store', [HolderController::class, 'store'])->name('holder.store');
        Route::get('/holder/edit/{id}', [HolderController::class, 'edit'])->name('holder.edit');
        Route::post('/holder/update', [HolderController::class, 'update'])->name('holder.update');
        Route::get('/holder/delete/{id}', [HolderController::class, 'delete'])->name('holder.delete');
    });

    Route::get('/policy/holder/{id}', [HolderController::class, 'show'])->name('holder.show');

    // Holder find data;
    Route::get('/holder/data/find/select/{id}/month', [HolderController::class, 'select_month'])->name('holder.find.data.select.month');
    Route::post('/holder/data/find/select/month', [HolderController::class, 'select_month_set'])->name('holder.find.data.select.set.month');
    Route::get('/holder/data/find/select/{month}/{year}/{id}', [HolderController::class, 'get_monthly_data'])->name('holder.get.monthly.data');


    /*
    |--------------------------------------------------------------------------
    | Deposit Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::get('/deposit/policy-select', [DepositController::class, 'policy_select'])->name('deposit.policy.select');
    Route::post('/deposit/policy-select', [DepositController::class, 'policy_select_get'])->name('deposit.policy.select.get');
    Route::get('/deposit/money/create/{id}', [DepositController::class, 'add_money_create'])->name('deposit.money.create');
    Route::post('/deposit/money/sore/{id}', [DepositController::class, 'add_money_store'])->name('deposit.money.store');

    /*
    |--------------------------------------------------------------------------
    | Withdraw Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::get('/withdraw/select-policy', [WithdrawController::class, 'select_policy'])->name('withdraw.select.policy');
    Route::post('/withdraw/select-policy', [WithdrawController::class, 'select_policy_add'])->name('withdraw.select.policy.add');
    Route::get('/withdraw/check-ability/{id}', [WithdrawController::class, 'check_ability'])->name('withdraw.check.ability');
    Route::get('/withdraw/create/{id}', [WithdrawController::class, 'create'])->name('withdraw.create');
    Route::post('/withdraw/store/{id}', [WithdrawController::class, 'store'])->name('withdraw.store');


    /*
    |--------------------------------------------------------------------------
    | Loan Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::middleware(['admin'])->group(function() {
        Route::get('/loan/all/account', [LoanController::class, 'index'])->name('loan.index');
        Route::get('/loan/all/account/list', [LoanController::class, 'list'])->name('loan.list');
        
        Route::get('/loan/account/create', [LoanController::class, 'create_account'])->name('loan.account.create');
        Route::post('/loan/account/create', [LoanController::class, 'create_account_store'])->name('loan.account.store');
        Route::get('/loan/select/policy', [LoanController::class, 'select_policy'])->name('loan.select.policy');
        Route::post('/loan/select/policy', [LoanController::class, 'select_policy_store'])->name('loan.select.policy.store');
        Route::get('/loan/ability-check/{id}', [LoanController::class, 'ability_check'])->name('loan.ability.check');
        Route::get('/loan/give-loan/{id}', [LoanController::class, 'give_loan'])->name('loan.give');
        Route::post('/loan/give-loan', [LoanController::class, 'give_loan_store'])->name('loan.give.store');
        Route::get('/loan/delete/{id}', [LoanController::class, 'delete'])->name('loan.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Installment Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::get('/installment/select-policy', [InstallmentController::class, 'select_policy'])->name('ins.select.policy');
    Route::post('/installment/select-policy', [InstallmentController::class, 'ins_policy_store'])->name('ins.select.policy.store');
    Route::get('/installment/create/{id}', [InstallmentController::class, 'ins_create'])->name('ins.create');
    Route::post('/installment/store', [InstallmentController::class, 'ins_store'])->name('ins.store');



    /*
    |--------------------------------------------------------------------------
    | Search Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::middleware(['admin'])->group(function() {
        Route::get('/search/selection/{route}', [SearchController::class, 'select_date'])->name('search.selection');

        Route::get('/search/selection/day/{route}', [SearchController::class, 'day'])->name('search.select.day');
        Route::post('/search/selection/day', [SearchController::class, 'day_store'])->name('search.select.day.store');
        Route::get('/search/selection/day/{route}/{day}/{month}/{year}', [SearchController::class, 'search_data_by_day'])->name('search.data.by.day');
    
        Route::get('/search/selection/month/{route}', [SearchController::class, 'month'])->name('search.select.month');
        Route::post('/search/selection/month', [SearchController::class, 'month_store'])->name('search.select.month.store');
        Route::get('/search/selection/month/{route}/{month}/{year}', [SearchController::class, 'search_data_by_month'])->name('search.data.by.month');
    
        Route::get('/search/selection/year/{route}', [SearchController::class, 'year'])->name('search.select.year');
        Route::post('/search/selection/year', [SearchController::class, 'year_store'])->name('search.select.year.store');
        Route::get('/search/selection/year/{route}/{year}', [SearchController::class, 'search_data_by_year'])->name('search.data.by.year');
    
        Route::get('/search/selection/total/{route}', [SearchController::class, 'total'])->name('search.select.total');
        Route::get('/search/selection/total/{route}/get-data', [SearchController::class, 'search_data_by_total'])->name('search.data.by.total');

    });





    /*
    |--------------------------------------------------------------------------
    | PDF Download;
    |--------------------------------------------------------------------------
    |
    */

    Route::get('/pdf/by-day/{route}/{day}/{month}/{year}', [PdfDownloadController::class, 'by_day'])->name('pdf.by.day');
    Route::get('/pdf/by-month/{route}/{month}/{year}', [PdfDownloadController::class, 'by_month'])->name('pdf.by.month');
    Route::get('/pdf/by-year/{route}/{year}', [PdfDownloadController::class, 'by_year'])->name('pdf.by.year');
    Route::get('/pdf/by-total/{route}', [PdfDownloadController::class, 'by_total'])->name('pdf.by.total');
    


     /*
    |--------------------------------------------------------------------------
    | User route;
    |--------------------------------------------------------------------------
    |
    */

    Route::get('/user/change-password', [UserController::class, 'change_password'])->name('user.change.password');
    Route::post('/user/change-password', [UserController::class, 'change_password_store'])->name('user.change.password.store');

    Route::middleware(['admin'])->group(function() {
        Route::get('/user/managers', [UserController::class, 'managers'])->name('user.manager.index');
        Route::get('/user/managers/create', [UserController::class, 'managers_create'])->name('user.manager.create');
        Route::post('/user/managers/store', [UserController::class, 'managers_store'])->name('user.manager.store');
        Route::get('/user/managers/delete/{id}', [UserController::class, 'managers_delete'])->name('user.manager.delete');
    });

});

