<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    protected $table = 'donatur';
    use HasFactory;

    protected $fillable =[
        'user_id',
        'foto',
        'alamat',
        'no_identitas',
        'tanggal_lahir',
        'no_telp'
    ];

    public function donasi(){
        return $this->hasMany(Donasi::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
