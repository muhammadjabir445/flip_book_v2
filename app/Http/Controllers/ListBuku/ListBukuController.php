<?php

namespace App\Http\Controllers\ListBuku;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListBukuController extends Controller
{
    public function index(Request $request) {
        $buku = \App\Models\Book::with('category')
        ->where('status',1)
        ->search($request)
        ->categori($request)
        ->orderBy('created_at','desc')
        ->paginate(12);
        $kategori = \App\Models\MasterDataDetail::where('id_master_data',13)->get();
        return view('list-book',['buku'=>$buku,'category'=> $kategori]);
    }
}
