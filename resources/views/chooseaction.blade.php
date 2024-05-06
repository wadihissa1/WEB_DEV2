@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Action</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
   
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-image: url("/images/createstore-background.webp");
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(10px);
        }
 
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            height:250px;
            margin: 90px auto;
            border: 2px solid #2b282825;
            background: radial-gradient(#fff, #ffd6d6);
            filter: blur(5px);
            transition: .5s ease-in-out;
        }
        form:hover{
            filter: blur(0px);
        }

        form:hover body{
            filter: blur(10px);
        }
 
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #ff523b;
        }
 
       
 
        .btn {
            background-color:  #ff523b;
            color: white;
            border: none;
            padding: 20px;
            border-radius: 10px;
            cursor: pointer;
            width: 80%;
            text-align:center;
            font-size:20px;
        }
        .btn:hover{
            background-color: #d63a1e;
 
        }
 
       
    </style>
 
</head>
<body>
    <form>
        <h1>Choose Action</h1>
        
        @if (session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
    
    <!-- View All Stores Button -->
       <a class="btn" href="{{ route('viewallstores', ['id' => $userId]) }}">View My Stores</a>
    
    <!-- Create Store Button -->
    <a class="btn" href="{{ route('createstore', ['id' => $userId]) }}">Create Store</a>
    
    </form>
    
</body>
</html>
@endsection