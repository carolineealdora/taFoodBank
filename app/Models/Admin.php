<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // use HasFactory;

    protected $table = 'admin';

    protected $fillable = [
        'id',
        'foto_profil',
        'no_identitas'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
