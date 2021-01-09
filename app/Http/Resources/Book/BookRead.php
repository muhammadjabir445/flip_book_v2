<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookRead extends JsonResource
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
        // $foto = \Storage::exists('public/' .$this->folder . "/{$direktori}" . "-0.jpg") ? asset('storage/' . $this->folder . "/{$direktori}" . "-0.jpg") :'';
        $foto = \Storage::exists('public/' .$this->folder . "/{$direktori}" . "-0.jpg") ? "data:image/png;base64," .base64_encode(file_get_contents(public_path('storage/' . $this->folder . "/{$direktori}" . "-0.jpg"))) :'';
        // $file = "$direktori" . "-0.jpg";
        // $foto = route('gambar.image',[$direktori,$file]);
        $page_akhir = $this->page - 1 ;
        $fotos = [];


        for ($i=0; $i < $this->pages ; $i++) {
            array_push($fotos,"data:image/png;base64," . base64_encode(file_get_contents(public_path('storage/' . $this->folder . "/{$direktori}" . "-$i.jpg"))));
        }
        $data = [
            'id' => $this->id,
            'judul' => $this->judul_buku,
            'kode' => $this->kode_buku,
            'penerbit' => $this->penerbit,
            'deskripsi' => $this->deskripsi,
            'foto' => $foto,
            'fotos' => $fotos,
            'harga' => $this->harga,
            'pages'=>$this->pages,
            'status' => $this->status,
            'categori' => $this->category ? $this->category->description : 'Belom ada kategori',
            'status_read' => $this->status_read ? $this->status_read : 2
        ];
        return $data;
    }
}
