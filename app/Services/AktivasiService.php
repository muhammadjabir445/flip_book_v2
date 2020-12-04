<?php
namespace App\Services;

use App\Jobs\CreatePdf;
use App\Models\Aktivasi;
use App\Models\AktivasiDetail;
use App\Models\Book;
use App\Models\Deskripsi;
use DB;
use PDF;

class AktivasiService {
    public static function store($request) {

       try {
            $date = \Carbon\Carbon::now();
            DB::beginTransaction();
            $error = 0;
            $data = [
                'aktivasi' => []
            ];
            $book = Book::where('kode_buku',$request->kode_buku)->first();
            $aktivasi = new Aktivasi();
            $aktivasi->total_aktivasi = $request->total;
            $aktivasi->id_buku = $book->id;
            $aktivasi->tanggal = $date->format('Y-m-d');
            $aktivasi->file = 'aktivasi/' . \Str::random(100) . '.pdf';

            $html = '<table style="width:100%;border-collapse: separate;
            border-spacing: 15px;">';
            $awal = 0;
            if ($aktivasi->save()) {
                for ($i=0; $i < $request->total ; $i++) {
                    $detailAktivasi = new AktivasiDetail();
                    $detailAktivasi->id_aktivasi = $aktivasi->id;
                    $detailAktivasi->kode = $date->format('Ymd') .\Str::upper(\Str::random(10));
                    if($detailAktivasi->save()){
                        // $html = $html . " <div style='border: 1px solid black;
                        // width: 33%;
                        // padding: 10px;
                        // box-sizing: border-box;
                        // display: inline-block;
                        // margin-bottom: 2px;'>
                        // Judul Buku : <br> $book->judul_buku
                        // <br>
                        // Kode Aktivasi : <br> $detailAktivasi->kode
                        // <br>
                        // Kode Buku : <br> $book->kode_buku
                        // </div>";
                            if ($awal == 0) $html = $html . '<tr style="">';
                                $html = $html . "<td style='border: 1px solid black; padding:40px 20px 40px 20px;font-size:23px'>
                                    Judul Buku :  $book->judul_buku
                                    <br>
                                    Kode Aktivasi :  $detailAktivasi->kode
                                    <br>
                                    Kode Buku : $book->kode_buku
                                </td>";
                            if ($awal == 2) $html = $html . '</tr>';


                                ++$awal;


                            if ($awal >= 2) $awal=0;

                        continue;
                    }
                    else{
                        $error++;
                        throw new \Exception('Gagal simpan aktivasi');
                        break;
                    }
                }
            }


            $html = $html . '</table>';
            $pdf = \App::make('snappy.pdf.wrapper');
            $pdf->loadHTML($html);
            if(!$pdf->save(public_path('storage/' . $aktivasi->file))){
                $error++;
                throw new \Exception('Gagal simpan pdf');
            }
           if ($error === 0) {
               DB::commit();
               $message = 'Berhasil tambah aktivasi';
               $status = 200;
           }
       } catch (\Exception $e) {
            DB::rollback();

            $message = $e->getMessage();
            $status = 500;
       }

       return response()->json([
           'message' => $message
       ],$status);
    }


    public static function delete($id) {
        $aktivasi = Aktivasi::findOrFail($id);
        $aktivasi->detail()->delete();
        $aktivasi->delete();

        return response()->json([
            'message' => 'Berhasil hapus aktivasi'
        ],200);
    }

    public static function aktive_book($kode){
        $aktivasi = AktivasiDetail::with('aktivasi')->where('kode',$kode)->first();
        try {
            DB::beginTransaction();
            $error = 0;
            if ($aktivasi->status == 0) {
                $cek_buku = DB::table('book_user')
                ->where('id_buku', $aktivasi->aktivasi->id_buku)
                ->where('id_user',\Auth::user()->id)
                ->first();

                if ($cek_buku) {
                    $error++;
                    throw new \Exception('Anda Sudah memiliki Buku ini');
                }else {
                    $data = DB::table('book_user')->insert([
                        'id_user' => \Auth::user()->id,
                        'id_buku' =>  $aktivasi->aktivasi->id_buku,
                    ]);
                    $aktivasi->status = 1;
                    $aktivasi->id_user = \Auth::user()->id;
                    $aktivasi->save();
                }

            } else {
                $error++;
                throw new \Exception('Kode Sudah Terpakai');
            }

            if ($error === 0) {
                DB::commit();
                $message = 'Berhasil melakukan Aktivasi';
                $status = 200;
            }
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            $status = 500;
        }

        return response()->json([
            'message' => $message
        ],$status);
    }

    public static function cetak_pdf($id) {
        // $detailAktivasi = AktivasiDetail::with(['aktivasi'=>function($q) {
        //     $q->with(['book'=>function($q) {
        //         $q->select('id','kode_buku','judul_buku');
        //     }])->select('id','id_buku');
        // }])->select('id','kode','id_aktivasi')->where('id_aktivasi',$id)->get();

        // $html = '';
        // foreach ($detailAktivasi as $item) {
        //     $html = $html . " <div style='border: 1px solid black;
        //     width: 33%;
        //     padding: 10px;
        //     box-sizing: border-box;
        //     display: inline-block;
        //     margin-bottom: 2px;'>
        //        Judul Buku : <br> {$item->aktivasi->book->judul_buku}
        //        <br>
        //        Kode Aktivasi : <br> $item->kode
        //        <br>
        //        Kode Buku : <br> {$item->aktivasi->book->kode_buku}
        //     </div>";
        // }
        // $pdf = PDF::loadView('cetak.pdf', ['data'=>$detailAktivasi]);
        // $pdf = \App::make('snappy.pdf.wrapper');
        // $pdf->loadHTML($html);
        // return $pdf->download();
        $aktivasi = Aktivasi::findOrFail($id);
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>  'attachment; filename="'.$aktivasi->file.'"'
        ];
        // return new Response(asset('storage/' .$aktivasi->file),200,$headers);
        $path = public_path('storage/' . $aktivasi->file);
        return response()->download($path,'file.pdf',$headers);
        // return $detailAktivasi;
    }
}
