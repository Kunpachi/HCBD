<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/users', [UserController::class, 'index'])->name('users.index');


Route::get('/', fn() => redirect()->route('users.index'))->name('dashboard');
Route::get('/analytics', fn() => view('demo.analytics'))->name('analytics');
Route::get('/crm', fn() => view('demo.crm'))->name('crm');


Route::middleware('auth')->group(function () {
    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});


Route::get('/users', function () {
    // Contoh dummy array
    $users = [
        ['id'=>1,'name'=>'John Doe','email'=>'johndoe@user.com','verified'=>false],
        ['id'=>2,'name'=>'Hilda Rocha','email'=>'poqueqoxy@mailinator.com','verified'=>false],
        ['id'=>3,'name'=>'Guest','email'=>'guest@guest.com','verified'=>false],
    ];
    return view('users.index', compact('users'));
})->name('users.index');
