<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingSpot extends Model
{
    protected $fillable = [
        'parking_lot_id',
        'name',
        'zone',
        'address',
        'floor',
        'price_per_hour',
        'latitude',
        'longitude',
        'is_available',
        'status',
    ];

    public function parkingLot()
    {
        return $this->belongsTo(ParkingLot::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}