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
    padding: 0;
    background-color: #f9f9f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    text-align: center;
}

h1 {
    color: #333;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    text-decoration: none;
    color: white;
    background-color: #ff523b;;
    border-radius: 5px;
    font-size: 18px;
}

.btn:hover {
    background-color:  #ff523b;
}

        </style>
</head>
<body>
    <h1>Choose Action</h1>

    <!-- View All Stores Button -->
    <a class="btn" href="{{ route('viewallstores', ['id' => $userId]) }}">View My Stores</a>

    <!-- Create Store Button -->
  <a class="btn" href="{{ route('createstore',['id'=>$userId ]) }}">Create Store</a> 

</body>
</html>
