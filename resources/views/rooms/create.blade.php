@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Room</h2>
    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        @csrf
        <div class="mb-3">
        <label>Room Number</label>
        <input type="text" name="room_number" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Type</label>
        <input type="text" name="type" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Price (₱)</label>
        <input type="number" name="price" step="0.01" class="form-control" required>
    </div>
    <div class="mb-3 form-check">
    <input type="hidden" name="available" value="0">
    <input type="checkbox" name="available" value="1" class="form-check-input" {{ old('available') ? 'checked' : '' }}>
    <label class="form-check-label">Available</label>
</div>
    <div class="mb-3">
        <label>Room Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-success">Save</button>
    <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
</form>
</div>
@endsection
