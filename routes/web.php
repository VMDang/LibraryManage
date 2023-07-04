<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowBookController;
use App\Http\Controllers\ReturnBookController;     


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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', function (){
        return view('home');
    })->name('home');

    Route::controller(UserController::class)->group(function (){
        Route::prefix('/user')->group(function () {
            Route::get('/profile/{id?}',  'profile')->where('id', '[0-9]+')->name('user.profile');
            Route::post('/updateUserAjax','updateUserAjax')->name('user.update');
            Route::post('/recoverAccountAjax','recoverAccountAjax');
            Route::post('/lockAccountAjax','lockAccountAjax');
            Route::post('/deleteAccountAjax','deleteAccountAjax');
            Route::post('/updateRoleAjax','updateRoleAjax');
            Route::match(['post', 'get'],'/list','list')->name('user.list');
        });
    });
   

    // Route::resource('books', BookController::class)
    //     ->except(['create', 'edit']);

    Route::controller(BookController::class)->group(function (){
        Route::prefix('books')->group(function () {
            Route::get('list', [BookController::class, 'index'])->name('books.index');
            Route::get('create', [BookController::class, 'create'])->name('books.create');
            Route::post('create', [BookController::class, 'store'])->name('books.store');
            Route::get('{id}/edit', [BookController::class, 'edit'])->name('books.edit');
            Route::put('{id}', [BookController::class, 'update'])->name('books.update');
            Route::delete('{id}', [BookController::class, 'destroy'])->name('books.destroy');
        });
    });
   
    
   Route::controller(BorrowBookController::class)->group(function (){
        Route::prefix('/borrow')->group(function(){
            Route::get('/create', 'create')->name('borrow.create');
            Route::post('/create', 'store')->name('borrow.store'); 
            Route::get('/approve', 'approve')->name('borrow.approve');
            Route::get('/history', 'history')->name('borrow.history');
        });
   });
   
   Route::controller(ReturnBookController::class)->group(function (){
     Route::prefix('/return')->group(function (){
           Route::get('/create','create')->name('return.create');
           Route::get('/approve','approve')->name('return.approve');
           Route::post('/create','store')->name('return.store');
    });
});
});

require __DIR__.'/auth.php';
