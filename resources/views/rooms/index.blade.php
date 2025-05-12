@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Room Management</h2>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Add New Room</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Type</th>
                <th>Price</th>
                <th>Available</th>
                <th>Image</th> <!-- Added Image column -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($rooms as $room)
            <tr>
                <td>{{ $room->room_number }}</td>
                <td>{{ $room->type }}</td>
                <td>₱{{ $room->price }}</td>
                <td>{{ $room->available ? 'Yes' : 'No' }}</td>
                <td>
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="Room Image" style="width: 100px; height: 75px; object-fit: cover;">
                    @else
                        <span>No image</span>
                    @endif
                </td> <!-- Display room image -->
                <td>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
