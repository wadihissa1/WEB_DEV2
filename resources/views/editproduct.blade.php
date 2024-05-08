@extends('layout')
@section('content')
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
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
<body>
    <h1>Edit Product</h1>

    @if ($errors->any())
        <div>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="store_id" value="{{ $product->store_id }}">
    <!-- Name -->
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $product->name }}">
    
    <!-- Description -->
    <label for="description">Description:</label>
    <textarea id="description" name="description">{{ $product->description }}</textarea>
    
    <!-- Price -->
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" value="{{ $product->price }}">
    
    <!-- Quantity -->
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}">
    
    <!-- Image -->
    <label for="image">Image:</label>
<input type="file" id="image" name="image">
@if($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" alt="Old Product Image" style="max-width: 100px;">
@endif
<br><br>
    <!-- Category -->
    <label for="category">Category:</label>
    <select id="category" name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    <br><br>
    <button type="submit">Update</button>
</form>

</body>
</html>
@endsection