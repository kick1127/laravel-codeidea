<?php

use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\ContactBoardController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\PortfolioController;
use App\Http\Controllers\FileUpload;
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

Route::name('front.')->group(function () {    
     Route::view('/', 'index')->name('index');    
     Route::get('contact', [ContactController::class, 'index'])->name('contact');
     Route::post('contact', [ContactController::class, 'store'])->name('upload');
     Route::view('portfolio','front.portfolio')->name('portfolio');    
     Route::view('pf-view', 'front.portfolio-view')->name('pfview');
     Route::view('gallView', 'front.ajax.allView')->name('ajax-gallView');        
});

Route::prefix('admin')->name('admin.')->group(function () {

    #region Admin Un-authentication
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'index'])->name('login');
        Route::post('login', [LoginController::class, 'store']);
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    });
    #endregion Admin Un-authentication

    #region Admin Authentication
    Route::middleware(['auth', 'admin.view.data'])->group(function () {
        Route::get('', [IndexController::class, 'index'])->name('index');
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
        Route::get('register', [UserController::class, 'index'])->name('register');
        Route::post('register', [UserController::class, 'store']);
        Route::get('my-info', [UserController::class, 'show'])->name('my-info');
        Route::get('password', [UserController::class, 'password'])->name('password');
        Route::post('password', [UserController::class, 'updatePassword'])->name('update-password');        

        Route::resource('member', MemberController::class);
        Route::resource('master', MasterController::class);
        Route::resource('terms', TermsController::class);
        Route::resource('board', BoardController::class);
        Route::resource('board.content', ContentController::class)->middleware('board');

        Route::resource('contact-board', ContactBoardController::class);
        Route::get('download/{file}', [ContactBoardController::class, 'download'])->name('contact-download');
        // Route::get('contact-board/{file}', 'ContactBoardController@download')->name('contact-download');

        Route::resource('file', FileController::class);
        Route::get('download/{originalName}/{filename}/{mimetype}',
            [FileController::class, 'download'])->name('download');
    });
    #endregion Admin Authentication

});
