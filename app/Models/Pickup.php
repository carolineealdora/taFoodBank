<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    protected $table = 'pickup';

    protected $fillable =[
        'donasi_id',
        'nama',
        'photo',
        'deskripsi',
        'kategori',
        'satuan',
        'kuantitas',
        'expired',
        'waktu_pickup'
    ];

    public function donasiData(){
        return $this->belongsTo(Donasi::class);
    }

    public function dataKategori(){
        return $this->belongsTo(Kategori::class, "kategori");
        // return $this->belongsTo(Kategori::class, "id");
    }

    public function dataSatuan(){
        return $this->belongsTo(Satuan::class, "satuan");
        // return $this->belongsTo(Satuan::class, "id");
    }
}
