@extends('layout')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store->name }} | View Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .button{
        width: fit-content;
        background-color: rebeccapurple;
        color: #fff;
        border-radius: 10px;
        padding: 10px;
    }
    .follow{
        display: flex;
        justify-content: end;
        margin-right: 20px;
    }
</style>

<body>
    <h1>{{ $store->name }}</h1>
    <p>Description: {{ $store->description }}</p>
    <div class="follow">
    <a href="" class="button">Follow</i></a>
    </div>
    <div class="categories">

        <div class="small-container">

            <div class="row">

                @foreach ($products as $product)
                <div class="col-4">
                    <a href="/viewstore/{{ $product->id }}"><img src="images/product-1.jpg"></a>
                    <center><h3>{{ $product->name }}</h3></center>
                </div>
                @endforeach

            </div>

        </div>

        <div class="paginate">
            {{ $products->links() }}
        </div>
    </div>
</body>
</html>
@endsection
