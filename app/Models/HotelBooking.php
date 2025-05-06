<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
{
    use HasFactory;

    protected $table='hotel_bookings';

    protected $fillable=['image','placeName','location','member','rating','price','duration'];
}
