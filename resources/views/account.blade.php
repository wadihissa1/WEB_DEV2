
@extends('layout')
@section('content')




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account | RedStore</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


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
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="Indicator">
                        </div>


                        <form id="LoginForm" method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="email" id="email" name="email" placeholder="Enter Email">

                            <input type="password" id="password1" name="password" placeholder="Enter Password">

                            @if ($errors->has('login_failed'))
                                <p style="color: red;font-size: 12px;">{{ $errors->first('login_failed') }}</p>
                            @endif

                            <button type="submit" class="btn">Login</button>

                            <a href="{{ route('auth/google') }}" class="btn btn-google">
                                <i class="fab fa-google"></i>Sign in with Google</a>
                            <a href="{{ route('login.github') }}" class="btn btn-github">
                                <i class="fab fa-github"></i> Sign in with GitHub
                            </a>
                            <a href="{{ route('forgot.password') }}">Forgot password?</a>

                        </form>

                        <form id="RegForm" method="POST" action="/register">
                            @csrf
                            <input type="text" id="name" name="name" placeholder="Enter Name">

                            <input type="email" id="email" name="email" placeholder="Enter Email">

                            <input type="password" id="password" name="password" placeholder="Enter Password">

                            <select id="role" name="role">

                                <option value="buyer">Buyer</option>
                                <option value="seller">Seller</option>

                            </select>

                            <button type="submit" class="btn">Register</button>
                            @if(session('success'))
                                <p style="color: green;font-size: 12px;">{{ session('success') }}</p>
                            @endif

                            @if ($errors->has('registration_failed'))
                                <p style="color: red;font-size: 12px;">{{ $errors->first('registration_failed') }}</p>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- javascript -->

    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px"
            } else {
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
@endsection
