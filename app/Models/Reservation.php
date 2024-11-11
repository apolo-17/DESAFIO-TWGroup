<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'coworking_space_id', 'reservation_time', 'status'];

    protected $casts = [
        'reservation_time' => 'datetime',
    ];

    const STATUS = [
        'Pending' => 'Pending',
        'Accepted' => 'Accepted',
        'Rejected' => 'Rejected'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coworkingSpace()
    {
        return $this->belongsTo(CoworkingSpace::class);
    }
}
