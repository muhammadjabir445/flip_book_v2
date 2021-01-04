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
use App\Models\Gambar;

Route::get('/test',function(){
    $file_pdf= public_path("storage/file_pdf/X9bgUfM5IrO8cxyQLkDOSJgdpzn60MKFauk5wUtA.pdf");
        $output =  public_path("storage/file_pdf/dfdf".".jpg");


        exec("magick convert -size 1275x1650 -density 100x150 -background white -alpha remove {$file_pdf}[0] -resize 1275x1650 -quality 85 -sharpen 0x1.0 $output");
});

Route::get('/',function() {
    $buku = \App\Models\Book::inRandomOrder()->where('status',1)->limit(12)->get();
    $gambar = Gambar::all();
    return view('landing',['data'=>$buku,'gambar' => $gambar]);
})->name('landing');
Route::get('/aktivasi-akun/{kode_aktivasi}',function($kode_aktivasi) {
    $user = \App\User::where('kode_aktivasi',$kode_aktivasi)->update([
        'kode_aktivasi' => '',
        'status_akun' => true
    ]);

    return redirect('/login');
});
Route::get('/list-buku','ListBuku\ListBukuController@index')->name('buku-list');
Route::get('/artikels','Artikel\ArtikelFrontController@index')->name('artikels');
Route::get('/artikels/{slug}','Artikel\ArtikelFrontController@read')->name('artikels.read');
Route::get('/{any}',function(){
    return view('index');
})->where('any', '.*');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

