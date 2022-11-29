<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Middleware\CustomAuth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Http\Controllers\ForgotPasswordController;


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


//Laravel/UI Package Authentication
// Auth::routes();



//Custom Authentication Roure

Route::group(['middleware'=>['status']],function() {

    // Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->middleware('customauth'); 
    
    Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 

    Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
    
    Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
    
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    

});

Route::get('login', [CustomAuthController::class, 'index'])->name('login');

Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 


//User Forget Password Routes
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 

//Reset Password
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');    







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
