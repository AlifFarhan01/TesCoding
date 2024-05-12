<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;
    protected $table = 'penyewaan';
    protected $fillable = [
        'iduser',
        'idkendaraan',
        'tanggalsewa',
        'tanggalkembali',
        'totaltarif',
        'status',
    ];
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'idkendaraan', 'id');
    }
}
