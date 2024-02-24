<?php

use App\Http\Controllers\Auth\RoomController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('auth')->middleware('active')->middleware('verified')->group(function(){
    Route::redirect('/','auth/room')->name('user');
    Route::get('/room', [RoomController::class, 'index'])->name('auth.room');
    Route::get('/room/{id}/edit',[RoomController::class,'editUser'])->name('auth.room.editUser');
    Route::post('/room/{id}/edit', [RoomController::class,'update'])->name('auth.room.update');
    Route::get('/room/balance', [RoomController::class, 'balance'])->name('auth.room.balance');
    Route::post('/room',[RoomController::class, 'closeSession'])->name('auth.room.close')->withoutMiddleware('auth');

});
