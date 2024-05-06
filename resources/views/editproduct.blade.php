<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
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

    <!-- Category -->
    <label for="category">Category:</label>
    <select id="category" name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>

    <button type="submit">Update</button>
</form>

</body>
</html>
