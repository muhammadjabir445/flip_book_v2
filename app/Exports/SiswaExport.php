<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
class SiswaExport implements FromCollection , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $request;

    function __construct($request) {
            $this->request = $request;
    }

    public function collection()
    {
        return Book::with('category')
        ->search($this->request)
        ->categori($this->request)
        ->orderBy('judul_buku','ASC')
        ->get();
    }
    public function map($book): array
    {
        return [
            $book->kode_buku,
            $book->judul_buku,
            $book->penerbit,
            $book->category->name,
            $book->harga,
        ];
    }
    public function headings(): array
    {
        return [
            'Kode Buku',
            'Judul Buku',
            'Penerbit',
            'Category',
            'Harga',
        ];
    }
}
