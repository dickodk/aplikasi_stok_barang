<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangMasuk extends Model
{
    use HasFactory;
    protected $fillable = ['barangs_id', 'qty', 'harga_beli'];

    public function barangs () {
        return $this->belongsTo(barang::class, 'barangs_id', 'id');
    }


}

