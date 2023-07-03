<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\BorrowBookController;
use App\Http\Controllers\ReturnBookController;
<<<<<<< HEAD
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ViewBookController;
=======



>>>>>>> 43f457e7d921d5358d8c438abda2df53eae3a71e
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


    Route::resource('books', BookController::class) 
        ->except(['create', 'edit']);

    Route::controller(BookController::class)->group(function (){
        Route::prefix('/books')->group(function (){

        });
    });

   Route::controller(BorrowBookController::class)->group(function (){
        Route::prefix('/borrow')->group(function(){
            Route::get('/create', 'create')->name('borrow.create');
            Route::post('/create', 'store')->name('borrow.store');
            Route::get('/approve', 'approve')->name('borrow.approve');
        
            Route::get('/approve/getBorrowingOfInfoAjax/{id}', 'getBorrowingOfInfoAjax');
            Route::post('/approve/approveBorrowingAjax', 'approveBorrowingAjax');
        });
   });

   Route::controller(ReturnBookController::class)->group(function (){
     Route::prefix('/return')->group(function (){
           Route::get('/create','create')->name('return.create');
           Route::get('/approve','approve')->name('return.approve');
           Route::post('/create','store')->name('return.store');
    });
<<<<<<< HEAD
});
    Route::controller(HistoryController::class)->group(function (){
        Route::get('/history', 'history')->name('history.history');
    
});
    Route::controller(ViewBookController::class)->group(function (){
       Route::get('/viewbook', 'create')->name('viewbook.create');
       Route::get('/detail/{id?}',  'detail')->where('id', '[0-9]+')->name('viewbook.detail');

});
=======
   });
   Route::controller(CategoryController::class)->group(function (){
        Route::prefix('/category')->group(function () {
            Route::get('/list',  'showList')->name('category.list');
            Route::get('/add',  'addCategory')->name('category.add');
            Route::post('/add', 'store')->name('category.store'); 
            Route::post('/list/search', 'search')->name('category.search'); 
            Route::post('/list/delete', 'delete')->name('category.delete'); 
            Route::post('/update', 'update')->name('category.update'); 
        });
    });
    Route::controller(ShelfController::class)->group(function (){
        Route::prefix('/shelf')->group(function () {
            Route::get('/list',  'showList')->name('shelf.list');
            Route::post('/list/search',  'search')->name('shelf.search');
            Route::post('/list/update',  'update')->name('shelf.update');
            Route::post('/list/delete',  'delete');
            Route::get('/add',  'addShelf')->name('shelf.add');
            Route::post('/add', 'store')->name('shelf.store'); 
        });
    });
>>>>>>> 43f457e7d921d5358d8c438abda2df53eae3a71e
});

require __DIR__.'/auth.php';
