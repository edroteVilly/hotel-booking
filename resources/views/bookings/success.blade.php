<!-- resources/views/bookings/success.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="text-center">Booking Confirmed!</h2>
        <p class="text-center">Thank you for booking with us! Your booking has been confirmed.</p>
        <div class="text-center">
            <a href="{{ route('available.rooms') }}" class="btn btn-primary">Back to Room List</a>
        </div>
    </div>
@endsection
