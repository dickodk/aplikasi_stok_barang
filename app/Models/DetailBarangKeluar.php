<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangKeluar extends Model
{
    use HasFactory;
    protected $fillable = ['barangs_id', 'qty', 'harga_jual'];

     public function barang () {
        return $this->belongsTo(barang::class, 'barangs_id', 'id');
    }
}
