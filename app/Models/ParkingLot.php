<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingLot extends Model
{
    protected $fillable = [
        'name',
        'region',
        'address',
        'description',
    ];

    public function spots()
    {
        return $this->hasMany(ParkingSpot::class);
    }
}