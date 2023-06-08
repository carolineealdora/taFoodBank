<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $table = 'donatur';
    
    protected $primaryKey = 'id';
    
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

    public function user(){
        return $this->belongsTo(User::class);
    }
}
