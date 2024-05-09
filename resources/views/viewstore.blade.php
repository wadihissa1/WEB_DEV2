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

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container_head {
            background-color: #e67e22; /* Orange background */
            padding: 45px;
            color: #fff;
            text-align: center;
        }

        .container_head img {
            width: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 20px;
        }

        .follow {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            background-color: #e67e22; /* Orange button background */
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #d35400; /* Darker orange on hover */
        }

        .categories {
            margin-top: 30px;
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .col-4 {
            width: 30%;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .col-4:hover {
            transform: translateY(-5px);
        }

        .col-4 img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .col-4 h3 {
            padding: 10px;
            text-align: center;
            color: #333;
        }

        .col-4 button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #e67e22; /* Orange button background */
            color: #fff;
            border: none;
            border-radius: 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .col-4 button:hover {
            background-color: #d35400; /* Darker orange on hover */
        }

        .paginate {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .paginate .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 0;
            border-radius: 4px;
        }

        .paginate .pagination li {
            display: inline;
            margin: 0;
        }

        .paginate .pagination li a {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .paginate .pagination li.active a {
            z-index: 3;
            color: #fff;
            background-color: #337ab7;
            border-color: #337ab7;
        }
    </style>
</head>

<body>
    <div class="container_head">
        <img src="{{ asset('images/user-2.png') }}" alt="User Image">
        <h1>{{ $store->name }}</h1>
        <p style="word-wrap: break-word;">Description: {{ $store->description }}</p>

        @if (Auth::id() !== $user->id)
        <div class="follow">
            @if (Auth::User()->follows($store))
            <form method="POST" action="{{ route('users.unfollow', $store->id) }}">
                @csrf
                <button type="submit" class="button" style="background-color: red">Unfollow</button>
            </form>
            @else
            <form method="POST" action="{{ route('users.follow', $store->id) }}">
                @csrf
                <button type="submit" class="button">Follow</button>
            </form>
            @endif
        </div>
        @endif
    </div>

    <div class="categories">
        <div class="row">
            <h1>Newest Releases:</h1>

        <div>

            <div class="row">

                <h1>Newest Releases:</h1>

                @foreach ($products as $product)
                <div class="col-4">
                    <a href="/product_details/{{ $product->id}}"><img src="{{ asset('images/product-1.jpg') }}"></a>
                    <center>
                        <h3>{{ $product->name }}</h3>
                    </center>
                </div>
                @endforeach

            </div>
            @endforeach
        </div>

        <div class="paginate">
            {{ $products->links() }}
        </div>
    </div>
</body>

</html>
@endsection
