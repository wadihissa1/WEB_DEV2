
@extends('layout')
@section('content')

<style>
    body {
            font-family: Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            background-color: #f5f5f5;
            background-image: url("/images/createstore-background.webp");
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px);
        }

        .form-container {
            background: radial-gradient(#fff, #ffd6d6);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            border: 2px solid #2b282825;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 90px auto;
        }

        h1 {
            text-align: center;
            margin: 30px auto;
            color: #ff523b;
            font-size: 55px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: black;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            border-color: #ff523b;
        }

        button {
            background-color:  #ff523b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #fff;
            color: #d63a1e;
            border: 1px solid #d63a1e;
        }
        .category{
            display: flex;
            justify-content: space-between;
            margin: 5px auto;
        }
</style>

<!-- Event creation form -->
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
@endsection