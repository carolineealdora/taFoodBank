<?php

namespace App\Models;

use App\Models\DonasiKonsumsi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuan';

    protected $fillable = [
        'nama'
    ];

    public function donasiKonsumsi(){
        return $this->hasMany(DonasiKonsumsi::class, 'satuan');
    }
}
