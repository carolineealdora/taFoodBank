<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NGO extends Model
{
    // use HasFactory;

    protected $fillable =[

    ];

    public function pic(){
        return $this->belongsTo(PIC::class);
    }
}
