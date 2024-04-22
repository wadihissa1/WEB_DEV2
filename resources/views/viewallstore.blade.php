<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Stores</title>
    <style>
        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>All Stores</h1>

    <!-- Your Stores Section -->
    <h2>Your Stores:</h2>
    @if($userStores && $userStores->count() > 0)
        <ul>
        <h1>Click to now more about your store:</h1>
            @foreach($userStores as $store)
                <li>
                    <a class="btn" href="{{ route('viewstore', ['store' => $store->id]) }}">{{ $store->name }}</a>
                    
                </li>
            @endforeach
        </ul>
    @else
        <p>You have no stores yet. Create your first store!</p>
    @endif
</body>
</html>
