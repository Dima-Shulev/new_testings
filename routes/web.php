<?php
use App\Http\Controllers\All\CategoryController;
use App\Http\Controllers\All\LoginController;
use App\Http\Controllers\All\PageController;
use App\Http\Controllers\All\QuestionController;
use App\Http\Controllers\All\RegisterController;
use App\Http\Controllers\All\TestingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Couchbase\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/',[PageController::class,'index'])->name('home');
Route::get('/{url}',[PageController::class,'show'])->name('show');

Route::get('/email/verify', function () {
    if(Auth::user()->email_verified_at){
        return redirect('/');
    }else{return view('auth.room.verify-email');}
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home')->with('success','success_verify_email');
})->middleware(['auth','signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth','throttle:6,1'])->name('verification.send');

Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::get('/login/forget', [LoginController::class, 'forget'])->name('login.forget');
    Route::post('/login/forget', [LoginController::class, 'checkMail'])->name('login.checkMail');
    Route::get('/login/check', [LoginController::class, 'check'])->name('login.check');
    Route::post('/login/check', [LoginController::class, 'checkCode'])->name('login.check-code');
    Route::get('/login/change/{id}', [LoginController::class, 'change'])->name('login.change');
    Route::post('/login/change', [LoginController::class, 'changePass'])->name('login.changePass');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/{url}', [CategoryController::class, 'show'])->name('categories.show');

    Route::prefix('testing')->group(function() {
        Route::get('/', [TestingController::class, 'index'])->name('testing');
        Route::get('/{id}/show', [TestingController::class, 'show'])->name('testing.show');
        Route::get('/{id}/question', [QuestionController::class, 'index'])->name('question');
        Route::get('/{id}/question/{questId}', [QuestionController::class, 'show'])->name('question.show');
        Route::post('/{id}/question/{questId}', [QuestionController::class, 'store'])->name('question.store');
        Route::get('/{id}/result/{count}', [TestingController::class, 'result'])->name('testing.result');
    });

});
