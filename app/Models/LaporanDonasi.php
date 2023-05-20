<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanDonasi extends Model
{
    use HasFactory;

    protected $table = 'laporan_donasi';

    protected $fillable =[
        'donasi',
        'foto_laporan',
        'deskripsi'
    ];

    public function donasi(){
        return $this->belongsTo(Donasi::class);
    }
}
