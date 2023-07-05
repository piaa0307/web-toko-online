<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKerajinan extends Model
{
    use HasFactory;

    protected $table = 'kategori_kerajinan';

    public $timestamps = false;

    public function getKerajinan()
    {
        return $this->hasMany('App\Models\KerajinanTangan', 'id_kategori', 'id');
    }
}
