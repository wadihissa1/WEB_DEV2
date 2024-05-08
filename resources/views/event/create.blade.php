@extends('layout')

@section('content')
<form method="POST" action="{{ route('events.store') }}">
    @csrf
    <label for="name">Event Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="4" required></textarea>

    <label for="date">Date:</label>
    <input type="date" name="date" id="date" required>

    <label for="time">Time:</label>
    <input type="time" name="time" id="time" required>

    <label for="store_id">Select Store:</label>
    <select name="store" id="store">
        @foreach($userStores as $store) <!-- Iterate over $userStores -->
        <option value="{{ $store->id }}">{{ $store->name }}</option>
        @endforeach
    </select>



    <button type="submit">Create Event</button>
</form>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection
