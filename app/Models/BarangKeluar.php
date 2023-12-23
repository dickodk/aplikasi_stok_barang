<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $fillable = ['id_customer', 'tgl_pengiriman', 'qty', 'no_surat_jalan', 'diskon'];
}
