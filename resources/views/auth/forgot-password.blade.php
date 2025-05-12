@extends('layouts.app') {{-- optional, if you already have Bootstrap layout setup --}}

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="min-width: 400px; max-width: 500px; width: 100%;">
        <div class="card-body">
            <h3 class="card-title text-center mb-3">Reset Your Password</h3>

            <p class="text-muted mb-4">
                Forgot your password? No problem. Enter your email and we'll send you a link to reset it.
            </p>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Send Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
