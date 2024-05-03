<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Categories</title>
</head>
<body>
    <h1>All Categories</h1>
    @if($categories->count() > 0)
        <ul>
            @foreach($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    @else
        <p>No categories found.</p>
    @endif
</body>
</html>
