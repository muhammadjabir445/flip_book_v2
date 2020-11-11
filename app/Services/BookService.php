<?php
namespace App\Services;

use App\Jobs\ProcessGenerate;
use App\Models\Book;
use App\Models\Deskripsi;
use DB;
use Illuminate\Support\Facades\Storage;

class BookService {
    protected static function set_page($pages) {
        $data = $pages;
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
    }
    public static function store($request) {

       try {
           $kode = \Str::lower($request->kode);
            DB::beginTransaction();
            $error = 0;
           $book = new Book();
           $book->judul_buku = $request->judul;
           $book->kode_buku = $kode;
           $book->penerbit = $request->penerbit;
           $file = $request->file('file')->store('file_pdf','public');
           $book->file = $file;
           $book->folder = 'data_buku/' . \Str::slug($kode,'-');
           $book->pages = $request->pages;
           if ($book->save()) {
               $deskripsi = json_decode($request->deskripsi);
               foreach ($deskripsi as $value) {
                   $book_deskripsi = new Deskripsi();
                   $book_deskripsi->title = $value->title;
                   $book_deskripsi->deskripsi = $value->deskripsi;
                   $book_deskripsi->id_buku = $book->id;
                   if (!$book_deskripsi->save()) {
                       $error++;
                       throw new \Exception('Gagal simpan deskripsi');
                        break;
                   }
               }
           } else {
                $error++;
                throw new \Exception('Gagal simpan buku');
           }
           if ($error === 0) {
               $page = BookService::set_page($request->pages);
               foreach ($page as $value) {
                    ProcessGenerate::dispatch($book,$value);
               }
               DB::commit();
               $message = 'Berhasil simpan buku';
               $status = 200;
            //    ProcessGenerate::dispatch($book);
           }
       } catch (\Exception $e) {
            DB::rollback();
            if (Storage::exists('public/' .$book->file)) {
                Storage::delete('public/' .$book->file);
            }

            $message = $e->getMessage();
            $status = 500;
       }

       return response()->json([
           'message' => $message
       ],$status);
    }

    public static function changeStatus($id) {
        $book = Book::findOrFail($id);
        $book->status = !$book->status;
        $book->save();
        return response()->json([
            'message' => 'Berhasil merubah status'
        ],200);
    }

    public static function update($request,$id) {
        $file_lama='';
       try {
            DB::beginTransaction();
            $error = 0;
           $kode = \Str::lower($request->kode);
           $book = Book::findOrFail($id);
           $book->judul_buku = $request->judul;
           $book->kode_buku = $kode;
           $book->penerbit = $request->penerbit;
           if ($request->file('file')) {
                $book->pages = $request->pages;
                $file_lama=$book->file;
                $file = $request->file('file')->store('file_pdf','public');
                $book->file = $file;
                $book->folder = 'data_buku/' . \Str::slug($kode,'-');

           }

           if ($book->save()) {
               if ($book->deskripsi()->delete() || $request->deskripsi) {
                    $deskripsi = json_decode($request->deskripsi);
                    foreach ($deskripsi as $value) {
                        $book_deskripsi = new Deskripsi();
                        $book_deskripsi->title = $value->title;
                        $book_deskripsi->deskripsi = $value->deskripsi;
                        $book_deskripsi->id_buku = $book->id;
                        if (!$book_deskripsi->save()) {
                            $error++;
                            throw new \Exception('Gagal simpan deskripsi');
                            break;
                        }
                    }
               }
           } else {
                $error++;
                throw new \Exception('Gagal simpan buku');
           }
           if ($error === 0) {
                if($request->file('file')){
                    if (Storage::exists('public/' .$file_lama)) {
                        Storage::delete('public/' .$file_lama);
                        Storage::deleteDirectory('public/' .$book->folder);
                    }
                    $page = BookService::set_page($request->pages);
                    foreach ($page as $value) {
                            ProcessGenerate::dispatch($book,$value);
                    }
                }
               DB::commit();
               $message = 'Berhasil edit buku';
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
        $book = Book::findOrFail($id);
        $book->deskripsi()->delete();
        if (Storage::exists('public/' .$book->file)) {
            Storage::delete('public/' .$book->file);
            Storage::deleteDirectory('public/' .$book->folder);
        }
        $book->delete();

        return response()->json([
            'message' => 'Berhasil hapus buku'
        ],200);
    }
}
