<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Aktivasi;
use App\Models\AktivasiDetail;
use App\Models\Book;
use App\User;
use Illuminate\Http\Request;

class DashboadController extends Controller
{
    public function index(){
        $user = User::select('id_role',\DB::raw('count(id) as total_user'))->where('id_role',25)->groupBy('id_role')->first();
        $book = Book::select(\DB::raw('count(id) as total_book'))->first();
        $book_publish = Book::select(\DB::raw('count(id) as total_book'))->where('status',1)->first();
        $total_aktivasi = Aktivasi::select(\DB::raw('sum(total_aktivasi) as totals'))->first();
        $kode = AktivasiDetail::join('aktivasis','aktivasis.id','=','aktivasi_details.id_aktivasi')
        ->join('books','books.id','=','aktivasis.id_buku')
        ->select('books.judul_buku as judul',\DB::raw('count(if(aktivasi_details.status = 1, aktivasi_details.status, NULL)) as total_aktive,count(if(aktivasi_details.status = 0, aktivasi_details.status, NULL)) as total_nonaktive'))
        ->groupBy('judul')
        ->get();

        return response()->json([
            'total_user' => $user->total_user,
            'total_buku' => $book->total_book,
            'total_buku_publish' => $book_publish->total_book,
            'total_aktivasi' => $total_aktivasi->totals,
            'total_kode' => $kode
        ]);
    }
}
