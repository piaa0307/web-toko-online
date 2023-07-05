<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function getPengguna()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function getKerajinan()
    {
        return $this->hasOne('App\Models\KerajinanTangan', 'id', 'id_kerajinan');
    }
}
