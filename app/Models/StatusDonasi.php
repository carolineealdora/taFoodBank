<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusDonasi extends Model
{
    use HasFactory;

    protected $table = 'status_donasi';

    protected $primaryKey = 'id';
    
    protected $fillable =[
        'nama'
    ];
    
    public function donasi(){
        return $this->hasOne(Donasi::class);
    }

}
