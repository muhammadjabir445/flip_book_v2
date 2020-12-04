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

use App\Models\AktivasiDetail;

Route::get('/test',function(){


    $data = AktivasiDetail::where('id_aktivasi',5)->get();
    return view('cetak.pdfv2',['data' => $data]);
});

Route::get('/',function() {
    $buku = \App\Models\Book::inRandomOrder()->where('status',1)->limit(16)->get();
    return view('landing',['data'=>$buku]);
})->name('landing');
Route::get('/{any}',function(){
    return view('index');
})->where('any', '.*');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

