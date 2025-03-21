<?php

use App\Http\Controllers\Admin\Index;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MasterCourierRatesController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// Add this ' ->middleware('verified') ' to protect the route with only verified users;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/adminlayout', function () {
    return view('layouts.admin');
});
Route::get('/dash', function () {
    return view('admin.index');
});

Route::group([
    'middleware' => ['auth', 'role:SuperAdmin|Admin|Manager', 'permission:AdminPanel access'],
    'namespace'  => 'App\Http\Controllers\Admin',
    'prefix'     => 'admin',
    'as'         => 'admin.'
], function () {
    Route::get('/', [Index::class, 'index'])->name('dashboard');

    Route::resource('profile', 'ProfileController');
    Route::patch('profile/{user}/passUpdate', [ProfileController::class, 'passUpdate'])->name('profile.passUpdate');
    Route::patch('profile/{user}/othersUpdate', [ProfileController::class, 'othersUpdate'])->name('profile.othersUpdate');

    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    // Route::resource('mastercourierrates', 'MasterCourierRatesController');
    // Route::post('mastercourierrates/upload', [MasterCourierRatesController::class, 'upload'])->name('mastercourierrates.upload');

    // Route::resource('rateCards','RateCardController')->name('rate.cards');


    Route::resource('users', 'UserController');
    Route::patch('users/{user}/passUpdate', [UserController::class, 'passUpdate'])->name('users.passUpdate');
    Route::patch('users/{user}/othersUpdate', [UserController::class, 'othersUpdate'])->name('users.othersUpdate');

    Route::resource('mastercourierrates', 'MasterCourierRatesController');
    // Route::patch('mastercourierrates/{user}/passUpdate', [MasterCourierRatesController::class, 'passUpdate'])->name('mastercourierrates.passUpdate');
    // Route::patch('mastercourierrates/{user}/othersUpdate', [MasterCourierRatesController::class, 'othersUpdate'])->name('mastercourierrates.othersUpdate');
    Route::post('mastercourierrates/import', [MasterCourierRatesController::class, 'import'])->name('mastercourierrates.import');
    Route::get('mastercourierrates/export', [MasterCourierRatesController::class, 'export'])->name('mastercourierrates.export');
});


/* Email Verification Links */
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
