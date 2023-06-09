<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogStatus extends Model
{
    use HasFactory;
    protected $table = 'log_status';

    protected $fillable =[
        'donasi_id',
        'status_message',
    ];

    public function donasi(){
        return $this->belongsTo(Donasi::class);
    }
}
