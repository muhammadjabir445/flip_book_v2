<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function deskripsi() {
        return $this->hasMany('App\Models\Deskripsi','id_buku');
    }

    public function scopeSearch($q, $request) {
        return $q->where('judul_buku','LIKE',"%$request->keyword%")
        ->orWhere('penerbit','LIKE',"%$request->keyword%")
        ->orWhere('kode_buku','LIKE',"%$request->keyword%");
    }
}
