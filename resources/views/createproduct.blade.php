@extends('layout')
@section('content')
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
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
</head>
<body>
    <h1>Create Product</h1>
    <form method="POST" action=" {{ route('storeproduct') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="3"></textarea>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price">
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" id="quantity">
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <div class="category">
            <label for="category">Category:</label>
            <select name="category_id" id="category" style="width: 80%">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- Add hidden input for store_id -->
        <input type="hidden" name="store_id" value="{{ $store->id }}">
        
        <button type="submit">Create Product</button>
    </form>
</body>
</html>
@endsection
