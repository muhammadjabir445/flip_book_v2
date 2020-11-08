<?php

namespace App\Http\Controllers\Aktivasi;

use App\Http\Controllers\Controller;
use App\Models\Aktivasi;
use App\Models\AktivasiDetail;
use App\Services\AktivasiService;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class AktivasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $aktivasi = AktivasiDetail::with(['aktivasi'=> function($q) {
        //     $q->with(['book'=> function($q){
        //         $q->select('id','kode_buku','judul_buku');
        //     }])->select('id','tanggal','id_buku');
        // }])->select('kode','id','id_aktivasi')->get();
        // return $aktivasi;
        $aktivasi = Aktivasi::with(['book' => function($q) {
           $q->select('id','kode_buku','judul_buku');
        }])
        ->select('id','id_buku','tanggal','total_aktivasi')
        ->whereHas('book', function($q) use($request){
           $q->where('judul_buku','LIKE',"%$request->keyword%");
        })
        ->paginate(10);
        return $aktivasi;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'kode_buku' => 'required|exists:books,kode_buku',
            'total' => 'required|between:1,10000'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],500);
        }
        return AktivasiService::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $aktivasi_detail = AktivasiDetail::with(['user' => function($q) {
            $q->select('id','name');
        }])
        ->select('id','kode','status','id_user',\DB::raw("CASE WHEN status = 1 then 'TERPAKAI' WHEN status = 0 then 'BELUM TERPAKAI' END as status_code"))
        ->where('id_aktivasi',$id)
        ->search($request)
        ->paginate(10);
        return $aktivasi_detail;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function pdf($id) {
        return AktivasiService::cetak_pdf($id);
    }

    public function aktivasi_active($kode){
        return AktivasiService::aktive_book($kode);
    }

    public function aktivasi_check(Request $request){
        $validator = \Validator::make($request->all(),[
            'kode' => 'required|exists:aktivasi_details,kode',
        ],
        [
            'kode.required'=> 'Kode Tidak ada',
            'kode.exists' => 'Kode yang anda masukkan salah'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],500);
        }
        $aktivasi = AktivasiDetail::with('aktivasi.book')->where('kode',$request->kode)->first();
        return response()->json([
            'aktivasi' => $aktivasi
        ]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return AktivasiService::delete($id);
    }
}
