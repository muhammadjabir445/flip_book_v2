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
    $data = 56;
    $page = [];
    $start_page =0;
    $end_page = 99;
    if ($data > 100) {
        while ($data !== 0) {
            if ($data > 100) {
                array_push($page,"[$start_page-$end_page]");
                $start_page = $end_page + 1;
                $data = $data - 100;
                if ($data > 100) {
                    $end_page = $start_page + 99;
                } else {
                    $end_page = $data - 1;
                }
            } else {
                $end_page = $start_page + $end_page;
                array_push($page,"[$start_page-$end_page]");
                $data = 0;
            }
        }
    } else  {
        $end_page = $data - 1;
        array_push($page,"[$start_page-$end_page]");
    }
    return $page;
    // $user = \App\User::findOrFail(1);
    // $user->password = \Hash::make(123456);
    // $user->save();
    // $path = public_path();
    // $pdf = new Spatie\PdfToImage\Pdf($path . '\dummy.pdf');
    // $pdf->saveImage($path .'\test0.jpg');

});
Route::get('/{any}',function(){
    return view('index');
})->where('any', '.*');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

