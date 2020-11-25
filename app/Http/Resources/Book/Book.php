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
        $direktori = explode('/',$this->folder);
        $direktori = array_key_exists(1,$direktori) ? $direktori[1] : '';
        $foto = \Storage::exists('public/' .$this->folder . "/{$direktori}" . "-0.jpg") ? asset('storage/' . $this->folder . "/{$direktori}" . "-0.jpg") :'';
        $data = [
            'id' => $this->id,
            'judul' => $this->judul_buku,
            'kode' => $this->kode_buku,
            'penerbit' => $this->penerbit,
            'deskripsi' => $this->deskripsi,
            'foto' => $foto,
            'pages'=>$this->pages,
            'status' => $this->status,
            'categori' => $this->category ? $this->category->description : 'Belom ada kategori'
        ];
        if (\Auth::user()->id_role !== 25) {
            $data['file'] = asset('storage/' . $this->file);
        }

        return $data;
    }
}
