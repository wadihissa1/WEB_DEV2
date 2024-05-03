<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
    <style>
        /* Add your CSS styles here */
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
        <div>
            <label for="category">Category:</label>
            <select name="category_id" id="category">
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
