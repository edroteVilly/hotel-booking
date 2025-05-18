@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Invoice Preview</h2>
    
    <div class="card shadow-sm border-light rounded">
        <div class="card-header text-white bg-primary">
            <h5 class="card-title mb-0">Booking Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Room Number: <span class="text-primary">{{ $booking->room->room_number }}</span></h5>
                    <p><strong>Type:</strong> {{ $booking->room->type }}</p>
                    <p><strong>Price:</strong> ₱{{ number_format($booking->room->price, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <h5><span class="text-muted">Check-in:</span> {{ $booking->check_in }}</h5>
                    <h5><span class="text-muted">Check-out:</span> {{ $booking->check_out }}</h5>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Total Nights:</strong> <span class="text-success">{{ $totalNights }}</span></p>
                    <p><strong>Total Cost:</strong> <span class="text-danger">₱{{ number_format($totalCost, 2) }}</span></p>
                </div>
                <div class="col-md-6 text-end">
                    <p><strong>Status:</strong> <span class="badge bg-success">Confirmed</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
