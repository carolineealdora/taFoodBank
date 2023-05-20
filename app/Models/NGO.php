<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NGO extends Model
{
    use HasFactory;

    protected $table = 'ngo';

    protected $fillable =[
        'ngo_status',
        'ngo_nama',
        'ngo_alamat',
        'ngo_kota',
        'ngo_no_telp',
        'user_id'
    ];

    public function pic(){
        return $this->belongsTo(PIC::class);
    }


}
