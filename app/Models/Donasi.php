<?php

namespace App\Models;

use App\Models\NGO;
use App\Models\Kota;
use App\Models\Donatur;
use App\Models\StatusDonasi;
use App\Models\DonasiKonsumsi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';

    protected $primaryKey = 'id';

    protected $fillable =[
        'donatur',
        'ngo_tujuan',
        'nama_pickup',
        'alamat_pickup',
        'no_telp_pickup',
        'kota',
        'status_donasi'
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
