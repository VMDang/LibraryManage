<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

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

Route::middleware('auth')->group(function () {
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

});

require __DIR__.'/auth.php';
