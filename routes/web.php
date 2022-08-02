<?php

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
Route::prefix('admin')->middleware('auth')->group(function() {
// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        if (view()->exists('admin.index')) {
            $data = ['title' => 'Панель администратора'];
            return view('admin.index', $data);
        }

    });


    Route::group(['prefix' => 'pages'], function () {

        Route::get('/', ['uses' => 'admin\PagesController@index', 'as' => 'pages']);
        Route::get('/add', ['uses' => 'admin\PagesController@create', 'as' => 'pagesAdd']);
        Route::post('/add', ['uses' => 'admin\PagesController@store', 'as' => 'pagesStore']);
        Route::delete('/edit/{page}', ['uses' => 'admin\PagesController@destroy', 'as' => 'pagesDestroy']);
        Route::get('/edit/{page}', ['uses' => 'admin\PagesController@edit', 'as' => 'pagesEdit']);
        Route::patch('/edit/{page}', ['uses' => 'admin\PagesController@update', 'as' => 'pagesUpdate']);
     
    });


    Route::resource('/portfolios', 'admin\PortfolioController', ['except' => [
        'show'
    ]]);


    Route::group(['prefix' => 'services'], function () {
        Route::get('/', ['uses' => 'admin\ServiceController@index', 'as' => 'services']);
        Route::get('/add', ['uses' => 'admin\ServiceController@create', 'as' => 'servicesAdd']);
        Route::post('/add', ['uses' => 'admin\ServiceController@store', 'as' => 'servicesStore']);
        Route::get('/edit/{service}', ['uses' => 'admin\ServiceController@edit', 'as' => 'servicesEdit']);
        Route::patch('/edit/{service}', ['uses' => 'admin\ServiceController@update', 'as' => 'servicesUpdate']);
        Route::delete('/edit/{service}', ['uses' => 'admin\ServiceController@delete', 'as' => 'servicesDelete']);


    });
});

Route::get('/', ['uses' => 'IndexController@index', 'as' => 'home']);
Route::post('/', ['uses' => 'IndexController@sendMail', 'as' => 'mail']);
Route::get('/page/{alias}', ['uses' => 'PageController@execute', 'as' => 'page']);

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(); 
// Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
