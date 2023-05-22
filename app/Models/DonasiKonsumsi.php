<?php

namespace App\Models;

use App\Models\Donasi;
use App\Models\Satuan;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonasiKonsumsi extends Model
{
    use HasFactory;

    protected $table = 'donasi_konsumsi';

    protected $fillable =[
        'donasi',
        'nama',
        'photo',
        'deskripsi',
        'kategori',
        'satuan',
        'kuantitas',
        'expired'
    ];

    public function donasi(){
        return $this->belongsTo(Donasi::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class);
    }
}
