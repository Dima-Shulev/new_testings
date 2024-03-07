<?php
use App\Http\Controllers\Auth\RoomController;
use App\Http\Controllers\Auth\TestingController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('auth')->middleware('active')->middleware('verified')->group(function(){
    Route::redirect('/','auth/room')->name('user');
    Route::get('/room', [RoomController::class, 'index'])->name('auth.room');
    Route::get('/room/{id}/edit',[RoomController::class,'editUser'])->name('auth.room.editUser');
    Route::post('/room/{id}/edit', [RoomController::class,'update'])->name('auth.room.update');
    Route::get('/room/balance', [RoomController::class, 'balance'])->name('auth.room.balance');
    Route::post('/room',[RoomController::class, 'closeSession'])->name('auth.room.close')->withoutMiddleware('auth');

    Route::prefix('testing')->group(function () {
        Route::controller(TestingController::class)->group(function () {
            Route::get('/{id}', 'index')->name('auth.testing');
            Route::get('/{id}/create', 'create')->name('auth.testing.create');
            Route::post('/{id}/store', 'store')->name('auth.testing.store');
            Route::get('/{id}/edit', 'edit')->name('auth.testing.edit');
            Route::post('/{id}/update', 'update')->name('auth.testing.update');
            Route::get('/{id}/active/{active}/user/{userId}', 'publicTesting')->name('auth.testing.public');
            /*Route::delete('/{id}/destroy', 'destroy')->name('admin.testing.destroy');*/
        });
        Route::get('/howQuestion', function () {
            return view('auth.testing.create');
        });
    });
});
