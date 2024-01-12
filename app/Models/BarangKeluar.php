<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $fillable = ['customers_id', 'tgl_pengiriman', 'qty', 'no_surat_jalan', 'diskon'];

    public function customer () {
        return $this->belongsTo(customer::class, 'customers_id', 'id');
    }


}
