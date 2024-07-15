<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Authenticatable
{
    use Notifiable;
    protected $guard = 'driver';
    protected $fillable = [
    'name', 'email', 'password',
    ];
    protected $hidden = [
    'password', 'remember_token',
    ];
}
