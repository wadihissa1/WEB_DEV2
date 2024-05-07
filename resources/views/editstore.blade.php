@extends('layout')
@section('content')





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Store</title>
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
    </style>
</head>
<body>
    <h1>Edit Store</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('updatestore', ['storeId' => $store->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Store Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $store->name) }}">
        
        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ old('description', $store->description) }}</textarea>

        <button type="submit">Update Store</button>
    </form>
</body>
</html>
@endsection