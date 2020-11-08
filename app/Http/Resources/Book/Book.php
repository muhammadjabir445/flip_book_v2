<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class Book extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul_buku,
            'kode' => $this->kode_buku,
            'penerbit' => $this->penerbit,
            'deskripsi' => $this->deskripsi,
            'file' => asset('storage/' . $this->file),
            'pages'=>$this->pages,
            'status' => $this->status
        ];
    }
}
