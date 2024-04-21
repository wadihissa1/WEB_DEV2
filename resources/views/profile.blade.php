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
            </ul>
        </nav>
        <a href="{{ route('cart') }}"><img src="images/cart.png" width="30px" height="30px"></a>
        <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
    </div>
</div>

<!-- Account Page -->
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="images/image1.png" width="100%">
            </div>
            <div class="col-2">
                <div class="form-container">
                    <div class="form-btn">
                        <span onclick="login()">Edit Your Profile</span>
                        <hr id="Indicator">
                    </div>
                    <form method="POST" action="{{ route('profile.update', ['userId' => $user->id]) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" >

                        <div>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email">
                        </div>

                        <!-- Add input fields for other user information -->

                        <button type="submit">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <h3>Download Our App</h3>
                <p>Download App for Android and ios mobile phone.</p>
                <div class="app-logo">
                    <img src="images/play-store.png">
                    <img src="images/app-store.png">
                </div>
            </div>
            <div class="footer-col-2">
                <img src="images/logo-white.png">
                <p>Our Purpose Is To Sustainably Make the Pleasure and Benefits of Sports Accessible to the Many.
                </p>
            </div>
            <div class="footer-col-3">
                <h3>Useful Links</h3>
                <ul>
                    <li>Coupons</li>
                    <li>Blog Post</li>
                    <li>Return Policy</li>
                    <li>Join Affiliate</li>
                </ul>
            </div>
            <div class="footer-col-4">
                <h3>Follow Us</h3>
                <ul>
                    <li>Facebook</li>
                    <li>Twitter</li>
                    <li>Instagram</li>
                    <li>Youtube</li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="copyright">Copyright 2020 - Samwit Adhikary</p>
    </div>
</div>

<!-- javascript -->

<script>
    var MenuItems = document.getElementById("MenuItems");
    MenuItems.style.maxHeight = "0px";
    function menutoggle() {
        if (MenuItems.style.maxHeight == "0px") {
            MenuItems.style.maxHeight = "200px"
        }
        else {
            MenuItems.style.maxHeight = "0px"
        }
    }
</script>

<!-- Toggle Form -->
<script>
    var LoginForm = document.getElementById("LoginForm");
    var RegForm = document.getElementById("RegForm");
    var Indicator = document.getElementById("Indicator");
    function register() {
        RegForm.style.transform = "translatex(0px)";
        LoginForm.style.transform = "translatex(0px)";
        Indicator.style.transform = "translateX(100px)";

    }
    function login() {
        RegForm.style.transform = "translatex(300px)";
        LoginForm.style.transform = "translatex(300px)";
        Indicator.style.transform = "translate(0px)";

    }
</script>

</body>

</html>
