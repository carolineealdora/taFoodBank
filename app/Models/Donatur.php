<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $fillable =[

    ];

    public function donasi(){
        return $this->hasMany(Donasi::class);
    }
}
