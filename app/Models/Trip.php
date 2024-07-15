<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = 'trip'; // Assuming your table name is 'user_inputs'

    protected $fillable = ['startpoint', 'destination', 'money', 'date', 'time', 'duration', 'requirement'];

    public $timestamps = false; // Disable automatic timestamp management

    // You may define relationships with other models if needed, for example:
    // public function user() {
    //     return $this->belongsTo(User::class);
    // }

    // Additional methods or configurations can be added here
}
