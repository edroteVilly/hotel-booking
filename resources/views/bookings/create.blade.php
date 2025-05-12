@extends('layouts.app')

@section('content')
<div class="container">
<div>Generated URL: {{ route('bookings.create', $room->id) }}</div>

{{-- Debugging Output --}}
@if(isset($room))
    <p>DEBUG: Room ID = {{ $room->id }}, Price = {{ $room->price }}</p>
@else
    <p>DEBUG: Room not set!</p>
@endif

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
            <label class="form-label">Room Price</label>
            <input type="text" class="form-control" value="₱{{ number_format($room->price, 2) }}" disabled>
        </div>

        <button type="submit" class="btn btn-success w-100 mt-3">Confirm Booking</button>
    </form>

</div>
@endsection
