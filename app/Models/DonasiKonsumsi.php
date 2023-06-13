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

    protected $primaryKey = 'id';

    protected $fillable =[
        'donasi_id',
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

    public function dataKategori(){
        return $this->belongsTo(Kategori::class, 'kategori');
    }

    public function dataSatuan(){
        return $this->belongsTo(Satuan::class, 'satuan');
    }
}
