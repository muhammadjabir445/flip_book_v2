<?php
namespace App\Services;

use App\Models\Book;
use App\Models\Deskripsi;
use DB;
use Illuminate\Support\Facades\Storage;

class BookService {
    public static function store($request) {

       try {
            DB::beginTransaction();
            $error = 0;
           $book = new Book();
           $book->judul_buku = $request->judul;
           $book->kode_buku = $request->kode;
           $book->penerbit = $request->penerbit;
           $file = $request->file('file')->store('file_pdf','public');
           $book->file = $file;
           $book->folder = \Str::slug($request->judul,'-');
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
               DB::commit();
               $message = 'Berhasil simpan buku';
               $status = 200;
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

       try {
        DB::beginTransaction();
        $error = 0;
           $book = Book::findOrFail($id);
           $book->judul_buku = $request->judul;
           $book->kode_buku = $request->kode;
           $book->penerbit = $request->penerbit;
           if ($request->file('file')) {
                $book->pages = $request->pages;
                $file = $request->file('file')->store('file_pdf','public');
                $book->file = $file;
                $book->folder = \Str::slug($request->judul,'-');
           }

           if ($book->save()) {
               if ($book->deskripsi()->delete()) {
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
        }
        $book->delete();

        return response()->json([
            'message' => 'Berhasil hapus buku'
        ],200);
    }
}