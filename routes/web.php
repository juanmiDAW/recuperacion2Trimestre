<?php

use App\Http\Controllers\MuebleController;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\returnSelf;

Route::view('/', 'muebles.index');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::resource('muebles', MuebleController::class);

Route::post('/register', function(){
    return view('livewire.pages.auth.register');
})->name('register');
