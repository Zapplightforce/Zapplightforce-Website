<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    redirect('/login');
} );

Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');
Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user')->middleware('throttle:login');


Route::middleware('LoggedIn')->group(function (){
    Route::get('/registration', [CustomAuthController::class, 'registration'])->name('registration');
    Route::get('/login', [CustomAuthController::class, 'login'])->name('login');
    Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');
// input security question routes
    Route::post('/submit-question', [CustomAuthController::class, 'submitQuestion'])->name('submitQuestion');
// Reset password routes
    Route::get('/password-reset', [CustomAuthController::class, 'pwdResetView'])->name('password-reset');
    Route::get('/askSecurityQuestion', [CustomAuthController::class, 'askSecurityQuestion'])->name('askSecurityQuestion');
    Route::get('/new-password', [CustomAuthController::class, 'newPasswordView'])->name('newPassword');
    Route::post('/updatePassword', [CustomAuthController::class, 'updatePassword'])->name('updatePassword');
});

Route::middleware('LoggedOut')->group(function (){
    Route::get('/home', [DashboardController::class, 'home'])->name('home');
    Route::get('/news', [NewsController::class, 'index'])->name('news');

});
