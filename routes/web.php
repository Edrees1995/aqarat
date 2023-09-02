<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

# -------------------------------------------- Here is start of users routes --------------------------------------------

Route::prefix('user')->name('user.')->group(function () {
    Route::middleware(['guest:web'])->group(function () {
        Route::view('/login', 'website.user.login')->name('login');
        Route::view('/register', 'website.user.register')->name('register');
        Route::post("/create", [UserController::class, "create"])->name('create');
        Route::post("/login-user", [UserController::class, "login_user"])->name("login-user");
    });

    Route::middleware(['auth:web'])->group(function () {
        Route::view('/home', 'website.user.home')->name('home');
        Route::post("/user/logout", [UserController::class, "logout"])->name('logout');
    });
});

# -------------------------------------------- Here is start of users routes --------------------------------------------



# -------------------------------------------- Here is start of admin routes --------------------------------------------

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::view('/login', 'website.admin.login')->name('login');
        Route::post("/login", [AdminController::class, "login"])->name("create-login");
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::view('/home', 'website.admin.home')->name('home');
        Route::post("/logout", [AdminController::class, "logout"])->name('logout');
    });
});



# -------------------------------------------- Here is end of admin routes   --------------------------------------------