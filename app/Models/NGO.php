<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

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
        'user_id',
        'pic_foto',
        'no_identitas'
    ];

    public function userData(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function kotaData(){
        return $this->belongsTo(Kota::class, "ngo_kota");
    }
}
