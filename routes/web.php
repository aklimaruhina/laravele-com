<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\Admin\BrandController;

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

// Route::get('/', function () {
//     // return view('welcome');
// });
Route::get('/', [FrontendController::class, 'index']);
Route::get('/about', [FrontendController::class, 'about']);
Route::get('/product', [FrontendController::class, 'product'])->name('product');
Route::get('/details', [FrontendController::class, 'details'])->name('details');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/events', [FrontendController::class, 'events'])->name('events');
Route::get('/cat/{slug}', [FrontendController::class, 'cat_details'])->name('cat_details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::resource('admin/category', CategoryController::class);
    Route::resource('admin/product', ProductController::class);
    Route::resource('admin/brand', BrandController::class);
});

require __DIR__.'/auth.php';
