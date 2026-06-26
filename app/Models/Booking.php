<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'parking_spot_id',
        'name',
        'phone',
        'car_number',
        'duration_minutes',
        'start_time',
        'end_time',
        'total_price',
        'qr_code',
        'status',
    ];

    public function spot()
    {
        return $this->belongsTo(ParkingSpot::class, 'parking_spot_id');
    }

    public function parkingSpot()
    {
        return $this->belongsTo(ParkingSpot::class, 'parking_spot_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}