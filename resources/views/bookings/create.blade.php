@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">Book Room {{ $room->room_number }} - {{ $room->type }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <div class="mb-3">
                            <label for="check_in" class="form-label">Check-in Date</label>
                            <input type="date" name="check_in" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="check_out" class="form-label">Check-out Date</label>
                            <input type="date" name="check_out" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="guest_name" class="form-label">Full Name</label>
                            <input type="text" name="guest_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="guest_email" class="form-label">Email Address</label>
                            <input type="email" name="guest_email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="guest_phone" class="form-label">Phone Number</label>
                            <input type="text" name="guest_phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Room Price</label>
                            <input type="text" class="form-control" value="₱{{ number_format($room->price, 2) }}" disabled>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3">
                            Confirm Booking
                        </button>

                        <a href="{{ route('available.rooms') }}" class="btn btn-link d-block text-center mt-2">← Back to Room List</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
