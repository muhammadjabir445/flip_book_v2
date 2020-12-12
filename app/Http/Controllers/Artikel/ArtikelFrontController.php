<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelFrontController extends Controller
{
    public function index(){
        $data = Artikel::orderBy('created_at','desc')->paginate(10);
        return view('artikel.index',['data'=>$data]);
    }

    public function read($slug) {
        $data = Artikel::where('slug',$slug)->first();
        return view('artikel.show',['item'=>$data]);
    }
}
