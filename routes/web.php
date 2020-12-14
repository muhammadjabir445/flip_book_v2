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
    $now = \Carbon\Carbon::now();
    $now = $now->format('Y-m-d H:i:s');
    $user = \App\User::select('updated_at',\DB::raw("TIMESTAMPDIFF(hour, updated_at, '$now') as jam"))
    ->where(\DB::raw("TIMESTAMPDIFF(hour, updated_at, '$now')"),'>=',24)
    ->get();
    return $user;
    // // return storage_path('kode.png');
    // $data = AktivasiDetail::where('id_aktivasi',5)->get();
    // return view('cetak.pdfv2',['data' => $data]);
});

Route::get('/',function() {
    $buku = \App\Models\Book::inRandomOrder()->where('status',1)->limit(12)->get();
    return view('landing',['data'=>$buku]);
})->name('landing');
Route::get('/list-buku','ListBuku\ListBukuController@index')->name('buku-list');
Route::get('/artikels','Artikel\ArtikelFrontController@index')->name('artikels');
Route::get('/artikels/{slug}','Artikel\ArtikelFrontController@read')->name('artikels.read');
Route::get('/{any}',function(){
    return view('index');
})->where('any', '.*');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

