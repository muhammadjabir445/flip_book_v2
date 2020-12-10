<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function deskripsi() {
        return $this->hasMany('App\Models\Deskripsi','id_buku');
    }

    public function category() {
        return $this->belongsTo('App\Models\MasterDataDetail','id_categori');
    }

    public function scopeSearch($q, $request) {
        return $q->where('judul_buku','LIKE',"%$request->keyword%")
        ->orWhere('penerbit','LIKE',"%$request->keyword%")
        ->orWhere('kode_buku','LIKE',"%$request->keyword%");
    }

    public function scopeCategori($q, $request) {
        if ($request->category) {
            return $q->where('id_categori',$request->category);
        }
    }

    public function user(){
        return $this->belongsToMany('App\User','book_user','id_buku','id_user');
    }
}
