<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $fillable = ['suppliers_id', 'tgl_penerimaan'];

    public function supplier () {
        return $this->belongsTo(supplier::class, 'suppliers_id', 'id');
    }

}

