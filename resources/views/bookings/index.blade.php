@extends('layouts.app')

<style>
    .pagination {
        justify-content: center;
        margin-top: 20px;
    }

    .page-link {
        border-radius: 10px;
        margin: 0 4px;
        color: #343a40;
    }

    .page-item.active .page-link {
        background-color: #198754;
        border-color: #198754;
    }

    .page-link:hover {
        background-color: #e9ecef;
    }

    .text-muted {
        display: none !important;
    }

    .room-card img {
        height: 200px;
        width: 100%;
        object-fit: cover;
    }

    .room-card {
        transition: transform 0.2s ease-in-out;
    }

    .room-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .pagination-info {
        text-align: center;
        margin-top: 10px;
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Available Rooms</h2>

    @if($rooms->count() > 0)
        <div class="row">
            @foreach ($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded room-card">
                        <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image" class="card-img-top rounded-top">

                        <div class="card-body">
                            <h5 class="card-title text-center text-primary">Room {{ $room->room_number }}</h5>
                            <p class="card-text text-center">{{ $room->type }}</p>
                            <p class="card-text text-center text-success">Price: ₱{{ number_format($room->price, 2) }}</p>

                            @if($room->available)
                                @auth
                                    <a href="{{ route('bookings.create', $room->id) }}" class="btn btn-success w-100">Book Now</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-success w-100"
                                       onclick="alert('Please login or register to book a room.');">
                                       Book Now
                                    </a>
                                @endauth
                            @else
                                <div class="text-center text-danger mt-2">
                                    <p><strong>Room Unavailable</strong></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination & Info -->
        <div class="d-flex flex-column align-items-center mt-4">
            <div class="pagination-info">
                Showing {{ $rooms->firstItem() }} to {{ $rooms->lastItem() }} of {{ $rooms->total() }} results
            </div>
            {{ $rooms->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-warning text-center" role="alert">
            No rooms are available for booking at the moment.
        </div>
    @endif
</div>
@endsection
