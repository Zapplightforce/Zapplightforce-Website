<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
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
    return redirect('/login');
});

Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user')->middleware('throttle:login');


Route::middleware('LoggedIn')->group(function (){
    Route::get('/registration', [CustomAuthController::class, 'registration'])->name('registration');
    Route::get('/login', [CustomAuthController::class, 'login'])->name('login');
    Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');
    Route::get('/password-reset', [CustomAuthController::class, 'pwdReset'])->name('password-reset');
});

Route::middleware('LoggedOut')->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/board', [DashboardController::class, 'board'])->name('board');

});
