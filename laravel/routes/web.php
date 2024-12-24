<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\MacAdressesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'showLoginForm']);
//Login for Wi-Fi Access
Route::post('/login', [LoginController::class, 'loginToInternet'])->name('login_guest');

Route::get('/success', [LoginController::class, 'showSuccess'])->name('success');
Route::get('/ban', function () {return view('ban');})->name('ban');

Route::get('/admin', function () { return view('admin'); })->name('admin');
Route::post('/admin', [LoginController::class, 'adminAuth'])->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('admin');
})->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'allData'])->name('dashboard');

    Route::get('/search', [UserController::class, 'search'])->name('user.search');

    Route::get('/dashboard/adduser', function () { return view('adduser'); })->name('user.add');
    Route::post('/dashboard/adduser', [UserController::class, 'createUser'])->name('user.create');

    Route::get('/dashboard/{id}', [UserController::class, 'editUser'])->name('user.edit');
    Route::put('/dashboard/{id}', [UserController::class, 'updateUser'])->name('user.update');
    Route::delete('/dashboard/{id}', [UserController::class, 'deleteUser'])->name('user.delete');
});

