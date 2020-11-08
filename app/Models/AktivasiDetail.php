<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivasiDetail extends Model
{
    public function aktivasi(){
        return $this->belongsTo('App\Models\Aktivasi','id_aktivasi');
    }

    public function user(){
        return $this->belongsTo('App\User','id_user');
    }
    public function scopeSearch($q,$request) {
        $status = $request->keyword == 'terpakai' ? 1 : ($request->keyword == 'belum terpakai' ? 0 : null);
        return $q->where('kode','LIKE',"%$request->keyword%")
        ->orWhere('status',$status);
    }
}
