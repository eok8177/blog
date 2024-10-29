<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Admin
Route::group([
    'as' => 'admin.',
    'middleware' => 'roles',
    'roles' =>['admin'],
    'prefix' => 'admin'
], function() {
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user',App\Http\Controllers\Admin\UserController::class);
    Route::resource('blog-category',App\Http\Controllers\Admin\BlogCategoryController::class);
    Route::resource('blog-page',App\Http\Controllers\Admin\BlogPageController::class);
    Route::resource('page',App\Http\Controllers\Admin\PageController::class);

    Route::get('settings',[App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings',[App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

});

// Front
// GET routes
$optionalLanguageRoutes = function() {
    Route::get('/', [App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');
    Route::get('/category/{slug}', [App\Http\Controllers\Front\HomeController::class, 'category'])->name('category');
    Route::get('/post/{slug}', [App\Http\Controllers\Front\HomeController::class, 'post'])->name('post');

    Route::get('/{slug}', [App\Http\Controllers\Front\HomeController::class, 'page'])->name('page');

};

// with prefix set before without prefix
Route::group([
    'prefix' => 'en',
    'as' => 'en.front.',
    'namespace' => 'Front',
    'middleware' => 'locale'
], $optionalLanguageRoutes);

Route::group([
    // 'prefix' => 'ua',
    'as' => 'ua.front.',
    'namespace' => 'Front',
    'middleware' => 'locale'
],$optionalLanguageRoutes);
