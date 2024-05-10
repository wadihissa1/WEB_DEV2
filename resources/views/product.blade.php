@extends('layout')
@section('content')




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedStore | Ecommerce Products</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
 }
 
.card {
    width:250px;
    height: fit-content;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    flex: 1 1 150px;
    border: 2px solid rgb(225, 225, 225);
    border-radius: 30px;
    background-color: #ffffffb0;
    color: #ff523b;
    box-sizing: border-box;
    margin: 1rem .25em;
    transition: .5s;
}
.product-image{
    width: 150px
}
</style>
<body>

<!-- All Products -->
<h1 class="title">All Products :</h1>
    <div class="cards">
    @foreach($randomProducts as $product)
    <a href="/product_details/{{ $product->id }}">
                <div class="card">
        <img  src="{{ asset('images\product-2.jpg')}}" alt="Product Image" class="product-image">
        <div class="product-details">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <br>
            <p>Price: ${{ $product->price }}</p>
            <p>Quantity: {{ $product->quantity }}</p>
            <br><br>
            <p>Category: {{ $product->category->name}}</p>
        </div>
    </div>
    </a>   
    @endforeach
    <div class="paginate">
        {{$randomProducts->links()}}
    </div>
</div>

</body>

</html>
@endsection
