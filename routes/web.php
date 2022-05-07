<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryDetailController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\ClassJobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
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

Route::get('/', function () {
    return view('welcome');
});

//route login dashboard
Route::middleware(['auth:sanctum', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('product', ProductController::class);
    Route::resource('product.gallery', ProductGalleryController::class)->only([
        'index', 'create', 'store', 'destroy'
    ])->shallow();
    Route::post('product/mark-sold/{product}', [ProductController::class, 'mark_sold'])->name('mark-sold');


    //route admin
    Route::middleware(['admin'])->group(function(){

        Route::resource('class-job', ClassJobController::class)->except([
            'show'
        ]);
        Route::resource('category', CategoryController::class)->except([
            'show'
        ]);
        Route::resource('category-detail', CategoryDetailController::class)->except([
            'show'
        ]);
        Route::resource('category-type', CategoryTypeController::class)->except([
            'show'
        ]);
        // Route::resource('inbox', ContactController::class)->only([
        //     'show', 'index'
        // ]);
    });
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
