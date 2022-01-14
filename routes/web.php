<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HolderController;
use App\Http\Controllers\PolicySelect;
use Illuminate\Support\Facades\Route;

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
    Route::get('/type-of-holder', function() {
        return view('front.selection.holder');
    })->name('holder.type');

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


    // Money route;
    Route::get('/collection-date', [CollectionController::class, 'collection_date'])->name('collection.date');
    Route::post('/collection-date', [CollectionController::class, 'collection_date_check'])->name('collection.date.check');
    Route::get('/collection/policy-select', [CollectionController::class, 'policy_select'])->name('collection.policy.select');
    Route::post('/collection/policy-select', [CollectionController::class, 'policy_select_get'])->name('collection.policy.select.get');
    Route::get('/collection/money/create/{id}', [CollectionController::class, 'add_money_create'])->name('collection.money.create');
    Route::post('/collection/money/sore/{id}', [CollectionController::class, 'add_money_store'])->name('collection.money.store');

});

require __DIR__.'/auth.php';
