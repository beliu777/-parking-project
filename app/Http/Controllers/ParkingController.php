<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use App\Models\ParkingSpot;

class ParkingController extends Controller
{
    public function home()
    {
        $lots = ParkingLot::with('spots')->get();

        return view('welcome', compact('lots'));
    }

    public function index()
    {
        $lots = ParkingLot::with('spots')->get();

        return view('parking.index', compact('lots'));
    }

    public function showLot(ParkingLot $lot)
    {
        $lot->load('spots');

        return view('parking.lot', compact('lot'));
    }
}