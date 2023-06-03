<?php

namespace App\Models;

use App\Models\NGO;
use App\Models\Donatur;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    protected $fillable =[
        'nama',
        'email',
        'password',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guard_name = 'web';

    public function ngo(){
        return $this->hasOne(NGO::class);
    }

    public function donatur(){
        return $this->hasOne(Donatur::class);
    }
    
    public function admin(){
        return $this->hasOne(Admin::class);
    }
}
