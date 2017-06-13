<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
          'name', 'email', 'password','last','cc',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
