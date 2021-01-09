<?php

use App\Models\Book;
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
Route::get('/gambar/buku/{category}/{file}',function($category,$file) {
    $buku = Book::select('kode_buku','pages')->where('kode_buku',$category)->first();
    $foto = [];
    for ($i=0; $i  < $buku->pages ; $i++) {
        array_push($foto,"data:image/png;base64," . base64_encode(file_get_contents(public_path('storage/data_buku/' . "$category/$category-$i.jpg"))));
    }
    // $user = \Auth::user();
    // if ($user) {
        // return  "data:image/png;base64," . base64_encode(file_get_contents(public_path('storage/data_buku/' . "$category/$file")));
    // } else {
    //     return "404";
    // }
    return $foto;

})->name('gambar.image');
Route::get('/get-sekolah','AuthJWT\AuthController@get_sekolah');
Route::resource('mencoba', 'Users\UsersController');

Route::middleware(['auth:api'])->group(function () {

	    Route::get('/aktivasi/check','Aktivasi\AktivasiController@aktivasi_check');
    	Route::get('/aktivasi/{kode}/aktive','Aktivasi\AktivasiController@aktivasi_active');
        Route::get('/gambar-landing','Gambar\GambarController@index');
        Route::post('/gambar-landing','Gambar\GambarController@store');
        Route::delete('/gambar-landing/{id}','Gambar\GambarController@destroy');
    	Route::group(['middleware' => ['can:menu']], function () {
            Route::get('/dahsboard','Dashboard\DashboadController@index');
            Route::get('/role-management','Role\RoleManagementController@index');
            Route::post('/role-management','Role\RoleManagementController@store');
            Route::get('/role-management/{id}/edit','Role\RoleManagementController@edit');
            Route::get('/books/{id}/status', 'Book\BookController@changeStatus');
            Route::get('/aktivasi/{id}/pdf','Aktivasi\AktivasiController@pdf');
            Route::get('/books-list/{category}','Book\BookController@books_list');
            Route::get('/my-book','Book\BookController@my_book');


            Route::get('/my-book/{kode}/read','Book\BookController@my_book_read');
            Route::get('books/category', 'Book\BookController@category');

            Route::apiResource('aktivasi', 'Aktivasi\AktivasiController');
            Route::resource('masterdata', 'Masterdata\MasterdataController');
            Route::resource('menu', 'Menu\MenuController');
            Route::resource('users', 'Users\UsersController');
            Route::resource('books', 'Book\BookController');
        });
        Route::resource('artikel', 'Artikel\ArtikelController');


});
