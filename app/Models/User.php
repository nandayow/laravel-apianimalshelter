<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
 
class User extends Authenticatable   implements MustVerifyEmail 
{
    use HasApiTokens, HasFactory, Notifiable;
    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rescuer(){
        return $this->hasOne('App\Models\Rescuer','user_id');
      }

      
      public function adopter(){
        return $this->hasOne('App\Models\Adopter','user_id');
      }
    
      public function personnel(){
        return $this->hasOne('App\Models\Personnel','user_id');
      }
      public function veterinarian(){
        return $this->hasOne('App\Models\Veterinarian','user_id');
      }
}
