<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Route::get('/', fn() => redirect()->route('users.index'))->name('dashboard');
// Route::get('/analytics', fn() => view('demo.analytics'))->name('analytics');
// Route::get('/crm', fn() => view('demo.crm'))->name('crm');


Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});


// Route::get('/users', function () {
//     // Contoh dummy array
//     $users = [
//         ['id'=>1,'name'=>'John Doe','email'=>'johndoe@user.com','verified'=>false],
//         ['id'=>2,'name'=>'Hilda Rocha','email'=>'poqueqoxy@mailinator.com','verified'=>false],
//         ['id'=>3,'name'=>'Guest','email'=>'guest@guest.com','verified'=>false],
//     ];
//     return view('users.index', compact('users'));
// })->name('users.index');


// Route::middleware('guest')->group(function () {
//     Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'showLogin'])->name('login');
//     Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login.perform');
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//     // contoh route users
//     Route::get('/users', function () {
//         $users = [
//             ['id'=>1,'name'=>'John Doe','email'=>'johndoe@user.com','verified'=>false],
//             ['id'=>2,'name'=>'Hilda Rocha','email'=>'poqueqoxy@mailinator.com','verified'=>false],
//             ['id'=>3,'name'=>'Guest','email'=>'guest@guest.com','verified'=>false],
//         ];
//         return view('users.index', compact('users'));
//     })->name('users.index');
// });