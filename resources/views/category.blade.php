<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Category</title>
</head>
<body>
    <h1>Create Category</h1>
    
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('storecategory') }}" method="POST">
        @csrf
        <div>
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <button type="submit">Create</button>
    </form>
</body>
</html>
