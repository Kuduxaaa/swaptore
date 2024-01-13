<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VisitorsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserDashboard;
use App\Models\Orders;
use App\Models\Product;
use PayzeIO\LaravelPayze\Facades\Payze;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/product/{product_id}/{product_name}', [ProductController::class, 'show'])->name('product');
Route::get('/product/{product_id}', [ProductController::class, 'show_with_id'])->name('product.withid');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/category/{cid}', [ProductController::class, 'categories'])->name('categories');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/cart', [CartController::class, 'show'])->name('cart');
    Route::get('/cart/delete/{product_id}', [CartController::class, 'removeFromCart'])->name('cart.delete');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

    Route::get('/profile', [UserDashboard::class, 'show'])->name('profile');
    Route::post('/profile/update', [UserDashboard::class, 'update_user_info'])->name('profile.update');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::group(['prefix' => 'admin'], function () {    
        Route::get('/categories', [CategoriesController::class, 'show'])->name('admin.categories');
        Route::post('/categories/new', [CategoriesController::class, 'add'])->name('admin.categories.add');
        Route::get('/categories/{id}/delete', [CategoriesController::class, 'destroy'])->name('admin.categories.delete');

        Route::get('/users/members', [UsersController::class, 'show_members'])->name('admin.user.members');
        Route::get('/users/admins', [UsersController::class, 'show_admins'])->name('admin.user.admins');
        Route::get('/users/{id}/delete', [UsersController::class, 'destroy'])->name('admin.user.delete');
        Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('admin.user.edit');
        Route::get('/users/new', [UsersController::class, 'edit'])->name('admin.user.add');
        Route::post('/users/{id}/edit', [UsersController::class, 'edit_perform']);
        Route::post('/users/new', [UsersController::class, 'edit_perform']);

        Route::get('/products', [ProductsController::class, 'show'])->name('admin.products');
        Route::get('/products/new', [ProductsController::class, 'add'])->name('admin.products.add');
        Route::post('/products/new', [ProductsController::class, 'store']);

        Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
        Route::post('/products/{id}/edit', [ProductsController::class, 'edit_perform']);
        Route::get('/products/{id}/delete', [ProductsController::class, 'destroy'])->name('admin.products.delete');

        Route::get('/visitors', [VisitorsController::class, 'index'])->name('admin.visitors');
        Route::get('/visitors/clear', [VisitorsController::class, 'clear'])->name('admin.visitors.clear');

        Route::get('/stats', [StatisticsController::class, 'index'])->name('admin.stats');
        Route::get('/orders', [OrdersController::class, 'show'])->name('admin.orders');
    });
});

Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth/login', [AuthController::class, 'proccess']);
Route::post('/auth/register', [AuthController::class, 'perform_register']);

Payze::routes();