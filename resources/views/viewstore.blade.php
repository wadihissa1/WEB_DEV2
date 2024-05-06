@extends('layout')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store->name }} | View Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .button {
        width: fit-content;
        background-color: rebeccapurple;
        color: #fff;
        border-radius: 10px;
        padding: 10px;
    }

    .follow {
        display: flex;
        justify-content: end;
        margin-right: 20px;
    }

    .container_head {
        background-color: #00000090;
        padding: 45px;
    }
</style>

<body>
    <div class="container_head">
        <img src="{{ asset('images/user-2.png') }}" alt="">
        <h1>{{ $store->name }}</h1>
        <p>Description: {{ $store->description }}</p>

        @if (Auth::id() !== $user->id)
        <div class="follow">
            {{-- @if (Auth::User()->follows($store)) --}}
            {{-- <form method="POST" action="{{ route('users.unfollow', $store->id) }}">
                @csrf
                <button type="submit" class="button" style="background-color: red">Unfollow</button>
            </form>
            @else --}}
            <form method="POST" action="{{ route('users.follow', $store->id) }}">
                @csrf
                <button type="submit" class="button">Follow</button>
            </form>
            {{-- @endif --}}
        </div>
        @endif
    </div>

    <div class="categories">

        <div>

            <div class="row">

                <h1>Newest Releases:</h1>

                @foreach ($products as $product)
                <div class="col-4">
                    <a href="/viewstore/{{ $product->id }}"><img src="{{ asset('images/product-1.jpg') }}"></a>
                    <center>
                        <h3>{{ $product->name }}</h3>
                    </center>
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