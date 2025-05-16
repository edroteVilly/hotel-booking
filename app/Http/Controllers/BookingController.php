<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as Pdf;
use Illuminate\Support\Facades\Log;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::where('available', 1)->paginate(6);  // Paginate the rooms
        return view('bookings.index', compact('rooms')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Room $room)
    {

        Log::info('Room ID = ' . $room->id . ', Price = ' . $room->price);
    
        return view('bookings.create', compact('room'));
    
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);
    
        // Check room availability
        if (!$this->checkAvailability($validated['room_id'], $validated['check_in'], $validated['check_out'])) {
            return redirect()->back()->withErrors('The room is not available for the selected dates.');
        }
    
        $user = auth()->user();
        $room = Room::findOrFail($validated['room_id']);
        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $numberOfNights = max(1, $checkIn->diffInDays($checkOut)); // ✅ fixed
    
        $totalPrice = $room->price * $numberOfNights;
    
        $booking = new Booking();
        $booking->user_id = $user->id;
        $booking->room_id = $validated['room_id'];
        $booking->check_in = $validated['check_in'];
        $booking->check_out = $validated['check_out'];
        $booking->total_price = $totalPrice;
        $booking->save();
    
        // Optionally mark the room as unavailable after booking
        $room->available = false;
        $room->save();
    
        return redirect()->route('bookings.success')->with('success', 'Your booking has been confirmed!');
    }
    

    public function showAvailableRooms()
    {
        $rooms = Room::where('available', true)->paginate(6);  // Paginate available rooms
        return view('bookings.index', compact('rooms'));
    }

    public function book($id)
    {
        $room = Room::find($id);

        if ($room && $room->available) {
            $room->available = false;
            $room->save();
            return redirect()->route('home')->with('success', 'Room booked successfully!');
        }

        return redirect()->route('home')->with('error', 'Room not available!');
    }

    private function checkAvailability($roomId, $checkIn, $checkOut)
    {
        $room = Room::findOrFail($roomId);
        $existingBooking = Booking::where('room_id', $roomId)
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            })
            ->exists();

        return !$existingBooking;
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('room')
            ->orderBy('check_in', 'desc')
            ->paginate(6);
    
        return view('bookings.my', compact('bookings'));
    }
    
    

    public function invoice($id)
    {
        $booking = Booking::with('room', 'user')->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $totalAmount = $booking->total_price;

        $pdf = Pdf::loadView('bookings.invoice', compact('booking', 'totalAmount'));
        return $pdf->download('invoice_booking_' . $booking->id . '.pdf');
    }

    public function success()
    {
        return view('bookings.success');
    }

    public function show($id)
{
    $booking = Booking::findOrFail($id);
    return view('bookings.show', compact('booking'));
}

public function adminIndex()
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Forbidden');
    }
    $bookings = \App\Models\Booking::with('user', 'room')->latest()->get();
    return view('admin.bookings.index', compact('bookings'));
}


}
