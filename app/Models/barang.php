<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    // protected $fillable = ['barang'];
    // protected $table= ['barangs'];
    protected $fillable = ['nama_barang', 'harga_jual', 'qty', 'jenis_barangs_id'];

    public function jenis_barang () {
        return $this->belongsTo(JenisBarang::class, 'jenis_barangs_id', 'id');
    }

    public function detailBarangMasuk () {
        return $this->hasMany(detailBarangMasuk::class, 'id', 'barangs_id');
    }
}
