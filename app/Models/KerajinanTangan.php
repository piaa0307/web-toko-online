<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerajinanTangan extends Model
{
    use HasFactory;

    protected $table = 'kerajinan_tangan';

    public function getKategori()
    {
        return $this->belongsTo('App\Models\KategoriKerajinan', 'id_kategori', 'id');
    }

    public function getPengrajin()
    {
        return $this->belongsTo('App\Models\User', 'id_pengrajin');
    }

    public function getKerajinanKeranjang()
    {
        return $this->belongsToMany('App\Models\Keranjang', 'kerajinan_keranjang', 'id_kerajinan', 'id_keranjang');
    }

    public function getOrder()
    {
        return $this->belongsTo('App\Models\Order', 'id_order');
    }
}
