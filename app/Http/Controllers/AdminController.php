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
        $totalRooms = Room::count();
        $totalBookings = Booking::count();
        $totalCustomers = User::where('role', 'customer')->count(); // Make sure users have a 'role'
        $totalRevenue = Booking::sum('total_price'); // If you store price per booking

        return view('admin.dashboard', compact('totalRooms', 'totalBookings', 'totalCustomers', 'totalRevenue'));
    }
}
