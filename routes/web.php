<?php

use Illuminate\Support\Facades\Route;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', function (){
        return view('home');
    })->name('home');

    Route::prefix('/user')->group(function () {
        Route::get('/profile/{id?}', [UserController::class, 'profile'])->where('id', '[0-9]+')->name('user.profile');
        Route::post('/updateUserAjax', [UserController::class, 'updateUserAjax'])->name('user.update');
        Route::post('/recoverAccountAjax', [UserController::class, 'recoverAccountAjax']);
        Route::post('/lockAccountAjax', [UserController::class, 'lockAccountAjax']);
        Route::post('/deleteAccountAjax', [UserController::class, 'deleteAccountAjax']);
        Route::post('/updateRoleAjax', [UserController::class, 'updateRoleAjax']);
        Route::match(['post', 'get'],'/list', [UserController::class, 'list'])->name('user.list');
    });
});

require __DIR__.'/auth.php';
