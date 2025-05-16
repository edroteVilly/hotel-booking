@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Room</h2>
    <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Room Number</label>
            <input type="text" name="room_number" class="form-control" value="{{ $room->room_number }}" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="{{ $room->type }}" required>
        </div>

        <div class="mb-3">
            <label>Price (₱)</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ $room->price }}" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="available" class="form-check-input" {{ $room->available ? 'checked' : '' }}>
            <label class="form-check-label">Available</label>
        </div>

        <div class="mb-3">
            <label>Current Room Image</label><br>
            @if ($room->image)
                <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image" width="200" class="mb-2">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        <div class="mb-3">
            <label>Upload New Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
