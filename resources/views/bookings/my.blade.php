@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">My Bookings</h2>

    @if($bookings->count() > 0)
        <div class="row">
            @foreach ($bookings as $booking)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border rounded">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Room {{ $booking->room->room_number }}</h5>
                            <p class="card-text mb-1"><strong>Type:</strong> {{ $booking->room->type }}</p>
                            <p class="card-text mb-1"><strong>Price:</strong> ₱{{ $booking->room->price }}</p>
                            <p class="card-text mb-1"><strong>Check-in:</strong> {{ $booking->check_in }}</p>
                            <p class="card-text mb-3"><strong>Check-out:</strong> {{ $booking->check_out }}</p>

                            <div class="d-flex justify-content-between align-items-center">
    <span class="badge bg-success">Confirmed</span>
    <!-- View and Download Buttons -->
    <a href="{{ route('invoice.preview', $booking->id) }}" class="btn btn-outline-info btn-sm" target="_blank">View Invoice</a>
    <a href="{{ route('invoice.download', $booking->id) }}" class="btn btn-outline-primary btn-sm">Download Invoice</a>
</div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $bookings->links() }}
        </div>
    @else
        <div class="alert alert-info text-center" role="alert">
            You don't have any bookings yet.
        </div>
    @endif
</div>
@endsection
