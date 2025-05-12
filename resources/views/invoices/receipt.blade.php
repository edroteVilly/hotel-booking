<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .details { margin-bottom: 20px; }
        .bold { font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        td, th { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Hotel Booking Invoice</h2>
    </div>

    <div class="details">
        <p><span class="bold">Booking ID:</span> {{ $booking->id }}</p>
        <p><span class="bold">Customer:</span> {{ $booking->name }}</p>
        <p><span class="bold">Room Number:</span> {{ $booking->room->room_number }}</p>
        <p><span class="bold">Room Type:</span> {{ $booking->room->type }}</p>
        <p><span class="bold">Check-in:</span> {{ $booking->check_in }}</p>
        <p><span class="bold">Check-out:</span> {{ $booking->check_out }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Price per Night</th>
                <th>Number of Nights</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $nights = \Carbon\Carbon::parse($booking->check_in)->diffInDays($booking->check_out);
                $price = $booking->room->price;
                $total = $price * $nights;
            @endphp
            <tr>
                <td>Room Booking</td>
                <td>₱{{ number_format($price, 2) }}</td>
                <td>{{ $nights }}</td>
                <td>₱{{ number_format($total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 20px;"><strong>Total Amount:</strong> ${{ number_format($total, 2) }}</p>
</body>
</html>
