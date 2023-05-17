<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable =[

    ];

    public function pickup(){
        return $this->hasMany(Pickup::class);
    }

    public function donasi_konsumsi(){
        return $this->hasMany(DonasiKonsumsi::class);
    }

    public function status_donasi(){
        return $this->belongsTo(StatusDonasi::class);
    }

    public function kota(){
        return $this->belongsTo(Kota::class);
    }

    public function ngo(){
        return $this->belongsTo(NGO::class);
    }

    public function donatur(){
        return $this->belongsTo(Donatur::class);
    }
}
