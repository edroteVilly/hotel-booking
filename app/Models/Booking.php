<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    public function user()
{
    return $this->belongsTo(User::class);
}

public function room()
{
    return $this->belongsTo(Room::class);
}

public function getTotalAmount()
{
    $check_in = \Carbon\Carbon::parse($this->check_in);
    $check_out = \Carbon\Carbon::parse($this->check_out);
    
    // Calculate the number of nights
    $nights = $check_in->diffInDays($check_out);
    
    // Total amount is price per night * number of nights
    return $this->room->price * $nights;
}


}
