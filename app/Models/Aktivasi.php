<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktivasi extends Model
{
    public function detail(){
        return $this->hasMany('App\Models\AktivasiDetail','id_aktivasi');
    }

    public function book(){
        return $this->belongsTo('App\Models\Book','id_buku');
    }
}
