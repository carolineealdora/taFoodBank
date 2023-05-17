<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PIC extends Model
{
    use HasFactory;

    
    protected $fillable =[

    ];

    public function ngo(){
        return $this->hasOne(NGO::class);
    }
}
