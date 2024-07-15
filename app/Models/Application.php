<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'drivers_application'; // Assuming your table name is 'user_inputs'

    protected $fillable = ['name', 'email', 'phone', 'profile_picture', 'vehicle_model', 'working experience', 'age'];

    public $timestamps = false; // Disable automatic timestamp management

    // You may define relationships with other models if needed, for example:
    // public function user() {
    //     return $this->belongsTo(User::class);
    // }

    // Additional methods or configurations can be added here
}