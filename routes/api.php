<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/reset-password','AuthJWT\AuthController@password_reset');
Route::post('/reset-password/{token}','AuthJWT\AuthController@password_reset_action');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/me','AuthJWT\AuthController@me');
Route::post('/register', 'AuthJWT\AuthController@register');
Route::post('/login', 'AuthJWT\AuthController@login');
Route::post('/logout', 'AuthJWT\AuthController@logout');
Route::post('/edit-profile','AuthJWT\AuthController@EditProfile');
Route::get('/setting-color','Setting\SettingController@color');

Route::get('/get-sekolah','AuthJWT\AuthController@get_sekolah');


Route::middleware(['auth:api'])->group(function () {
    Route::get('/aktivasi/check','Aktivasi\AktivasiController@aktivasi_check');
    Route::get('/aktivasi/{kode}/aktive','Aktivasi\AktivasiController@aktivasi_active');
    Route::group(['middleware' => ['can:menu']], function () {
        Route::get('/dahsboard','Dashboard\DashboadController@index');
        Route::get('/role-management','Role\RoleManagementController@index');
        Route::post('/role-management','Role\RoleManagementController@store');
        Route::get('/role-management/{id}/edit','Role\RoleManagementController@edit');
        Route::get('/books/{id}/status', 'Book\BookController@changeStatus');
        Route::get('/aktivasi/{id}/pdf','Aktivasi\AktivasiController@pdf');
        Route::get('/books-list','Book\BookController@books_list');
        Route::get('/my-book','Book\BookController@my_book');

        Route::get('/my-book/{kode}/read','Book\BookController@my_book_read');
        Route::get('books/category', 'Book\BookController@category');

        Route::apiResource('aktivasi', 'Aktivasi\AktivasiController');
        Route::resource('masterdata', 'Masterdata\MasterdataController');
        Route::resource('menu', 'Menu\MenuController');
        Route::resource('users', 'Users\UsersController');
        Route::resource('books', 'Book\BookController');
    });

});
