@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Admin Dashboard</h2>
    <div class="row text-white">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary p-3">
                <h5>Total Users</h5>
                <h3>{{ $totalUsers }}</h3>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success p-3">
                <h5>Total Rooms</h5>
                <h3>{{ $totalRooms }}</h3>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning p-3">
                <h5>Total Bookings</h5>
                <h3>{{ $totalBookings }}</h3>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-danger p-3">
                <h5>Total Income</h5>
                <h3>₱{{ number_format($totalIncome, 2) }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
