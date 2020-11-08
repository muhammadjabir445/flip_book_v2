<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function deskripsi() {
        return $this->hasMany('App\Models\Deskripsi','id_buku');
    }
}
