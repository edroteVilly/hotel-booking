@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Available Rooms</h2>
    <div class="row">
        @foreach ($rooms as $room)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Room {{ $room->room_number }}</h5>
                        <p class="card-text">Type: {{ $room->type }}</p>
                        <p class="card-text">₱{{ $room->price }} per night</p>
                        <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn btn-success">Book Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
