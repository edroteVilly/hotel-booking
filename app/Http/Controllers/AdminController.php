<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalRooms = Room::count();
        $totalBookings = Booking::count();
        $totalIncome = Booking::sum('total_price');
    
        return view('admin.dashboard', compact('totalUsers', 'totalRooms', 'totalBookings', 'totalIncome'));
    }
}
