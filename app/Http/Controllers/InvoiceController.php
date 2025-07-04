<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    // Download PDF
    public function downloadInvoice($id)
    {
        $booking = Booking::findOrFail($id);


        $checkIn = Carbon::parse($booking->check_in);
        $checkOut = Carbon::parse($booking->check_out);
        $totalNights = max(1, $checkOut->diffInDays($checkIn));
    
        return Pdf::loadView('bookings.invoice', [
            'booking' => $booking,
            'totalNights' => $totalNights,
        ])->download('booking_invoice_' . $booking->id . '.pdf');
    }

    // View invoice in browser
    public function viewInvoice($id)
    {
    // Get the booking based on the ID
    $booking = Booking::findOrFail($id);

    // Calculate the number of nights
    $checkIn = Carbon::parse($booking->check_in);  // Convert check-in date to Carbon instance
    $checkOut = Carbon::parse($booking->check_out);  // Convert check-out date to Carbon instance

    $totalNights = max(1, \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out));
    $totalCost = $booking->room->price * $totalNights;  // Multiply by the price per night

    // Pass the calculated values to the view
    return view('invoice.preview', [
        'booking' => $booking,
        'totalNights' => $totalNights,
        'totalCost' => $totalCost
    ]);
}

    // (Optional) Secure download using route model binding and auth
    public function generate(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $checkIn = Carbon::parse($booking->check_in);
        $checkOut = Carbon::parse($booking->check_out);
        $nights = $checkOut->diffInDays($checkIn);
        $total = $booking->room->price * max($nights, 1);

        $pdf = PDF::loadView('bookings.invoice', compact('booking', 'total'));
        return $pdf->download('invoice_booking_' . $booking->id . '.pdf');
    }

    public function showInvoicePage($bookingId)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($bookingId);

        // Calculate the number of nights
        $checkIn = Carbon::parse($booking->check_in);
        $checkOut = Carbon::parse($booking->check_out);
        $totalNights = $checkIn->diffInDays($checkOut);

        // Calculate the total cost
        $totalCost = $totalNights * $booking->room->price;

        // Return the view with necessary data
        return view('bookings/invoice-preview', [
            'booking' => $booking,
            'totalNights' => $totalNights,
            'totalCost' => $totalCost
        ]);
    }
}
