<?php

use App\Http\Controllers\Admin\CanteenController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\AdminCanteen\OverviewController;
use App\Http\Controllers\AdminCanteen\ProductController;
use App\Http\Controllers\AdminCanteen\ReportController;
use App\Http\Controllers\Superadmin\AdminController;
use App\Http\Controllers\Superadmin\CanteenController as SuperadminCanteenController;
use App\Http\Controllers\Superadmin\CategoryController;
use App\Http\Controllers\Superadmin\ClientController as SuperadminClientController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\ParkingSpotController;
use App\Http\Controllers\Superadmin\SmartCanteenController;
use App\Http\Controllers\Superadmin\SmartParkingController;
use App\Http\Controllers\Superadmin\StudentController;
use App\Http\Controllers\Auth\AuthController;

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['checkrole:admincanteen']], function () {
    Route::prefix('admin-canteen')->name('admin_canteen.')->group(function () {
        Route::prefix('overview')->name('overview.')->group(function () {
            Route::get('', [OverviewController::class, 'index'])->name('index');
            Route::put('status-canteen', [OverviewController::class, 'statusCanteen'])->name('status_canteen');
        });

        Route::prefix('report')->name('report.')->group(function () {
            Route::get('', [ReportController::class, 'index'])->name('index');
            Route::get('show/{id}', [ReportController::class, 'show'])->name('show');
            Route::get('getPager', [ReportController::class, 'getpager'])->name('get_pager');
            Route::put('updatePager', [ReportController::class, 'updatePager'])->name('update_pager');
            Route::put('updateTaken', [ReportController::class, 'updateTaken'])->name('update_taken');
            Route::put('updateNotif', [ReportController::class, 'updateNotif'])->name('update_notif');
            Route::delete('delete', [ReportController::class, 'delete'])->name('delete');
            // Route::get('cetak-nota/{id}', [ReportController::class, 'print'])->name('print');
        });
        Route::prefix('product')->name('product.')->group(function () {
            Route::get('', [ProductController::class, 'index'])->name('index');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('update', [ProductController::class, 'update'])->name('update');
            Route::delete('delete', [ProductController::class, 'delete'])->name('delete');
        });
    });
});

//Superadmin
Route::group(['middleware' => ['checkrole:superadmin', 'web']], function () {
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('', [DashboardController::class, 'index'])->name('index');
        });

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('', [AdminController::class, 'index'])->name('index');
            Route::get('create', [AdminController::class, 'create'])->name('create');
            Route::post('store', [AdminController::class, 'store'])->name('store');
            Route::get('{id}/edit', [AdminController::class, 'edit'])->name('edit');
            Route::put('update', [AdminController::class, 'update'])->name('update');
            Route::delete('delete', [AdminController::class, 'delete'])->name('delete');
        });
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('', [CategoryController::class, 'index'])->name('index');
            Route::get('create', [CategoryController::class, 'create'])->name('create');
            Route::post('store', [CategoryController::class, 'store'])->name('store');
            Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('update', [CategoryController::class, 'update'])->name('update');
            Route::delete('delete', [CategoryController::class, 'delete'])->name('delete');
        });
        Route::prefix('parking-spot')->name('parking_spot.')->group(function () {
            Route::get('', [ParkingSpotController::class, 'index'])->name('index');
            Route::get('create', [ParkingSpotController::class, 'create'])->name('create');
            Route::post('store', [ParkingSpotController::class, 'store'])->name('store');
            Route::get('{id}/edit', [ParkingSpotController::class, 'edit'])->name('edit');
            Route::put('update', [ParkingSpotController::class, 'update'])->name('update');
            Route::delete('delete', [ParkingSpotController::class, 'delete'])->name('delete');
        });
        Route::prefix('client')->name('client.')->group(function () {
            Route::get('', [SuperadminClientController::class, 'index'])->name('index');
            Route::get('blank', [SuperadminClientController::class, 'blank'])->name('blank');
            Route::get('create', [SuperadminClientController::class, 'create'])->name('create');
            Route::post('store', [SuperadminClientController::class, 'store'])->name('store');
            Route::get('{id}/edit', [SuperadminClientController::class, 'edit'])->name('edit');
            Route::put('update', [SuperadminClientController::class, 'update'])->name('update');
            Route::delete('delete', [SuperadminClientController::class, 'delete'])->name('delete');
        });
        Route::prefix('canteen')->name('canteen.')->group(function () {
            Route::get('', [SuperadminCanteenController::class, 'index'])->name('index');
            Route::get('create', [SuperadminCanteenController::class, 'create'])->name('create');
            Route::post('store', [SuperadminCanteenController::class, 'store'])->name('store');
            Route::get('{id}/edit', [SuperadminCanteenController::class, 'edit'])->name('edit');
            Route::put('update', [SuperadminCanteenController::class, 'update'])->name('update');
            Route::delete('delete', [SuperadminCanteenController::class, 'delete'])->name('delete');
        });

        Route::prefix('user')->name('student.')->group(function () {
            Route::get('', [StudentController::class, 'index'])->name('index');
            Route::get('create', [StudentController::class, 'create'])->name('create');
            Route::post('store', [StudentController::class, 'store'])->name('store');
            Route::get('{id}/edit', [StudentController::class, 'edit'])->name('edit');
            Route::put('update', [StudentController::class, 'update'])->name('update');
            Route::delete('delete', [StudentController::class, 'delete'])->name('delete');
        });

        Route::prefix('smart-canteen')->name('smart_canteen.')->group(function () {
            Route::get('', [SmartCanteenController::class, 'index'])->name('index');
        });
        Route::prefix('smart-parking')->name('smart_parking.')->group(function () {
            Route::get('', [SmartParkingController::class, 'index'])->name('index');
        });
    });
});
