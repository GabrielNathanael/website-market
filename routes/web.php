<?php

use App\Http\Controllers\ProductAdmin;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

route::get('/',[ProductController::class,'index']);
route::get('/product',[ProductController::class,'product']);
route::get('/productDesc',[ProductController::class,'productDesc']);
route::get('/cart',[ProductController::class,'cart']);
route::resource('productadmin',ProductAdmin::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    route::resource('productadmin',ProductAdmin::class);
});
Route::post('productadmin/search', [ProductAdmin::class, 'search'])->name('productadmin.search');

require __DIR__.'/auth.php';
