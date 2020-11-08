<?php

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
Route::get('/test',function(){
    $user = \App\User::findOrFail(1);
    $user->password = \Hash::make(123456);
    $user->save();
    $path = public_path();
    $pdf = new Spatie\PdfToImage\Pdf($path . '\dummy.pdf');
    $pdf->saveImage($path .'\test0.jpg');

});
Route::get('/{any}',function(){
    return view('index');
})->where('any', '.*');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

