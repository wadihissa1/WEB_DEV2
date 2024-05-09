@extends('layout')

@section('content')
    <!-- resources/views/auth/forgot-password.blade.php -->
    <form method="POST" action="{{ route('forgot.password.send') }}">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
            <span>{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Send Password Reset Link</button>
    </form>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
@endsection

