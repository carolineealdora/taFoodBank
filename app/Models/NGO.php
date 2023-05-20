<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NGO extends Model
{
    protected $table = 'ngo';
    // use HasFactory;

    protected $fillable =[
        'ngo_status',
        'ngo_nama',
        'ngo_alamat',
        'ngo_kota',
        'ngo_no_telp',
        'pic_foto',
        'pic_no_identitas'
    ];

    public function pic(){
        return $this->belongsTo(PIC::class);
    }


}
