<!DOCTYPE html>
<html>
<head>
    <title>Invoice - Booking #{{ $booking->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .invoice-box {
            padding: 30px;
            border: 1px solid #eee;
            font-size: 14px;
            line-height: 20px;
        }
        .heading { font-weight: bold; margin-bottom: 10px; }
        .text-right { text-align: right; }
        .border-bottom { border-bottom: 1px solid #ddd; margin-bottom: 10px; padding-bottom: 10px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <h2>Hotel Booking Invoice</h2>
        <div class="border-bottom">
            <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
            <p><strong>Name:</strong> {{ $booking->user->name }}</p>
            <p><strong>Email:</strong> {{ $booking->user->email }}</p>
        </div>

        <div class="border-bottom">
            <p><strong>Room:</strong> {{ $booking->room->room_number }} ({{ $booking->room->type }})</p>
            <p><strong>Price per Night:</strong> ${{ $booking->room->price }}</p>
            <p><strong>Check-in:</strong> {{ $booking->check_in }}</p>
            <p><strong>Check-out:</strong> {{ $booking->check_out }}</p>
        </div>

        <p class="text-right"><strong>Total ({{ $booking->getTotalAmount() }} nights):</strong> ${{ $totalAmount }}</p>
    </div>
</body>
</html>
