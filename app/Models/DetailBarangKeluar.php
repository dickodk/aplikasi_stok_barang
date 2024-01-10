<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangKeluar extends Model
{
    use HasFactory;
    protected $fillable = ['id_barang', 'qty', 'harga_jual'];

     public function barang () {
        return $this->belongsTo(barang::class, 'id_barang', 'id');
    }
}
