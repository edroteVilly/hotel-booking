@extends('layouts.app')

@section('content')
<div class="container">
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

        <div class="mb-3">
    <label class="form-label">Total Nights</label>
    <input type="text" id="total_nights" class="form-control" disabled>
</div>

<div class="mb-3">
    <label class="form-label">Total Cost</label>
    <input type="text" id="total_cost" class="form-control" disabled>
</div>


        <button type="submit" class="btn btn-success w-100 mt-3">Confirm Booking</button>
    </form>

</div>
<script>
    const checkInInput = document.querySelector('input[name="check_in"]');
    const checkOutInput = document.querySelector('input[name="check_out"]');
    const pricePerNight = {{ $room->price }};
    const nightsField = document.getElementById('total_nights');
    const costField = document.getElementById('total_cost');

    function updateTotals() {
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);

        if (checkInInput.value && checkOutInput.value && checkOut > checkIn) {
            const diffTime = Math.abs(checkOut - checkIn);
            const nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const total = nights * pricePerNight;

            nightsField.value = nights;
            costField.value = '₱' + total.toFixed(2);
        } else {
            nightsField.value = '';
            costField.value = '';
        }
    }

    checkInInput.addEventListener('change', updateTotals);
    checkOutInput.addEventListener('change', updateTotals);
</script>

@endsection
