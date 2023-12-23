<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    // protected $fillable = ['barang'];
    // protected $table= ['barangs'];
    protected $fillable = ['nama_barang', 'harga_jual', 'qty', 'id_jenis_barang'];
}
