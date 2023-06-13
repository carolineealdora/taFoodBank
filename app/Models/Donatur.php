<?php

namespace App\Models;

use App\Models\NGO;
use App\Models\Kota;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function userData(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function kota(){
        return $this->belongsTo(Kota::class, "id");
    }
}
