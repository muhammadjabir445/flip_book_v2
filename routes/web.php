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
    // $url = '/' . 'masterdata';
    // $url = \App\Models\Menu::where('url',$url)->first();
    // return $url->id;
    // $now = \Carbon\Carbon::parse('2020-11-13');
    // $before = \Carbon\Carbon::parse('2020-11-11 11:49:58');
    // $selisi = $before->diffInHours($now,false);
    return response()->json([
        'message' => 'test'
    ],200);
    // $user = \App\User::findOrFail(1);
    // $user->password = \Hash::make(123456);
    // $user->save();
    // $path = public_path();
    // $pdf = new Spatie\PdfToImage\Pdf($path . '\dummy.pdf');
    // $pdf->saveImage($path .'\test0.jpg');

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

