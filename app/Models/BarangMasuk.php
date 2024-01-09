<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $fillable = ['id_supplier', 'tgl_penerimaan'];

    public function supplier () {
        return $this->belongsTo(supplier::class, 'id_supplier', 'id');
    }

}

