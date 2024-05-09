<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products | RedStore</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<div class="container">
    <div class="navbar">
        <div class="logo">
            <a href="{{ route('index') }}"><img src="images/logo.png" alt="logo" width="125px"></a>
        </div>
        <nav>
            <ul id="MenuItems">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('product', ['id' => $userId]) }}">Products</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="{{ route('account') }}">Account</a></li>
                <!-- Add a link to see events -->
                <li><a href="{{ route('event.buyereventshow', ['userId' => $userId]) }}">See Events</a></li>
            </ul>
        </nav>
        
        <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
    </div>
</div>

<!-- All Products -->
<!-- Your existing code for displaying products -->

<!-- Footer -->
<!-- Your existing footer section -->

<!-- JavaScript -->
<!-- Your existing JavaScript code -->

</body>

</html>