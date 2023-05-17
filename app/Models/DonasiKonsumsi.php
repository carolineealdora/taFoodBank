<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiKonsumsi extends Model
{
    use HasFactory;

    protected $fillable =[

    ];

    public function donasi(){
        return $this->belongsTo(Donasi::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function jenis(){
        return $this->belongsTo(Jenis::class);
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class);
    }
}
