<!DOCTYPE html>
<html>
<head>
    <title>Invoice - Booking #{{ $booking->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            padding: 30px;
            font-size: 14px;
            line-height: 20px;
            color: #333;
        }

        .header, .footer {
            width: 100%;
            text-align: center;
            padding: 10px 0;
        }

        .header {
            border-bottom: 2px solid #333;
            margin-bottom: 20px;
        }

        .footer {
            border-top: 1px solid #ccc;
            font-size: 12px;
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
        }

        .logo {
            width: 120px;
            margin-bottom: 10px;
        }

        .border-bottom {
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.jpg') }}" class="logo" alt="Hotel Logo">
        <h2>Hotel Booking Invoice</h2>
    </div>

    <div class="invoice-box">
        <div class="border-bottom">
            <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
            <p><strong>Guest Name:</strong> {{ $booking->user->name }}</p>
            <p><strong>Email:</strong> {{ $booking->user->email }}</p>
        </div>

        <div class="border-bottom">
            <p><strong>Room Number:</strong> {{ $booking->room->room_number }}</p>
            <p><strong>Room Type:</strong> {{ $booking->room->type }}</p>
            <p><strong>Price per Night:</strong> ₱{{ number_format($booking->room->price, 2) }}</p>
            <p><strong>Check-in:</strong> {{ $booking->check_in }}</p>
            <p><strong>Check-out:</strong> {{ $booking->check_out }}</p>
        </div>

        <div class="border-bottom text-right">
            <p><strong>Total Nights:</strong> {{ $totalNights }}</p>
            <p><strong>Total Cost:</strong> ₱{{ number_format($booking->total_price, 2) }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Thank you for booking with us! — {{ config('app.name') }}</p>
    </div>
</body>
</html>
