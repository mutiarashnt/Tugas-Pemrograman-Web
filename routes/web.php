<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/hello-world', function () {
    return 'Ini adalah halaman hello world';
});

Route::get('/product', function () {
    return 'Ini adalah halaman produk';
});

Route::get('/chart', function () {
    return 'Ini adalah halaman keranjang';
});

Route::get('/checkout', function () {
    return 'Ini adalah halaman checkout';
});

Route::get('/order', function () {
    return 'Ini adalah halaman pesanan';
});

Route::get('/user', function () {
    return 'Ini adalah halaman pengguna';
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
