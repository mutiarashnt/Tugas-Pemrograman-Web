<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;


Route::get('/hello-world', function () {
    return 'Ini adalah halaman hello world';
});

//kode lama
// Route::get('/', function () {
//     $title = 'Homepage';
//     return view('web.homepage', ['title'=>$title]);
// });

//kode baru
Route::get('/', [HomepageController::class, 'index'])->name('home');
//route get / akan memanggil homepage controller yang berisi view index

Route::get('products', [ProductController::class, 'products']);
Route::get('product/{slug}', [HomepageController::class, 'product']);
Route::get('categories', [HomepageController::class, 'categories']);
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);


// Route::view()

// Route::get('/products', function () {
//     $title = 'Products';
//     return view('web.products', ['title'=>$title]);
// });

// Route::get('product/{slug}', function($slug){
//     $title = 'Single Product';
//     return view('web.single_product', ['title'=>$title, 'slug'=>$slug]);
// });

// Route::get('/categories', function () {
//     $title = 'Categories'; 
//     return view('web.categories', ['title'=>$title]);
// });

// Route::get('category/{slug}', function($slug){
//     $title = 'Single Category';
//     return view('web.single_categories', ['title'=>$title, 'slug'=>$slug]);
// });

// Route::get('/cart', function () {
//     $title = 'Cart';
//     return view('web.cart', ['title'=>$title]);
// });

// Route::get('/checkout', function () {
//     $title = 'Checkout';
//     return view('web.checkout', ['title'=>$title]);
// });

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products',ProductController::class); 
})->middleware(['auth', 'verified']); 

// Route::group(['prefix'=>'dashboard'], function(){
//     Route::get('/',[DashboardController::class,'index'])->name('Dashboard');
// })->middleware(['auth','verified']);

// //Route khusus untuk halaman admin
// Route::prefix('dashboard')->middleware(['auth'])->group(function () {
//     Route::resource('products', ProductController::class);
// });

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
