<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\TestingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('adminPanel')->group(function () {

    Route::get('/', [RoomController::class, 'admin'])->name('admin')->withoutMiddleware('adminPanel');
    Route::post('/', [RoomController::class, 'entrance'])->name('admin.entrance')->withoutMiddleware('adminPanel');
    Route::get('/room', [RoomController::class, 'index'])->name('admin.room');
    Route::get('/room/close', [RoomController::class, 'closeSession'])->name('admin.room.close');

    Route::prefix('users')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('admin.users');
            Route::get('/{id}/active/{active}', 'publicUser')->name('admin.users.publicUser');
            Route::get('/{id}/edit', 'edit')->name('admin.users.edit');
            Route::post('/{id}/edit', 'update')->name('admin.users.update');
            Route::delete('/{id}', 'delete')->name('admin.users.delete');
        });
    });

    Route::prefix('pages')->group(function() {
        Route::controller(PageController::class)->group(function(){
            Route::get('/','index')->name('admin.pages');
            Route::get('/create','create')->name('admin.pages.create');
            Route::post('/','store')->name('admin.pages.store');
            Route::get('/{url}/edit','edit')->name('admin.pages.edit');
            Route::post('/{id}','update')->name('admin.pages.update');
            Route::get('/{id}/active/{active}','publicPage')->name('admin.pages.publicPage');
            Route::delete('/{id}/deletePage','deletePage')->name('admin.pages.delete');
        });
    });

    Route::prefix('categories')->group(function() {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('admin.categories');
            Route::get('/create', 'create')->name('admin.categories.create');
            Route::post('/', 'store')->name('admin.categories.store');
            Route::get('/{url}/edit', 'edit')->name('admin.categories.edit');
            Route::post('/{id}', 'update')->name('admin.categories.update');
            Route::get('/{id}/active/{active}', 'publicCategory')->name('admin.categories.publicCategory');
            Route::delete('/{id}/deleteCategory', 'deleteCategory')->name('admin.categories.delete');
        });
    });

    Route::prefix('testing')->group(function () {
        Route::controller(TestingController::class)->group(function () {
            Route::get('/', 'index')->name('admin.testing');
            Route::get('/create', 'create')->name('admin.testing.create');
            Route::post('/', 'store')->name('admin.testing.store');
            Route::get('/{id}/edit', 'edit')->name('admin.testing.edit');
            Route::post('/{id}', 'update')->name('admin.testing.update');
            Route::get('/{id}/active/{active}', 'publicTesting')->name('admin.testing.public');
            Route::delete('/{id}/destroy', 'destroy')->name('admin.testing.destroy');
        });
        Route::get('/howQuestion', function () {
            return view('admin.testing.create');
        });
    });
});


