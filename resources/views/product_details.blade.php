@extends('layout')
@section('content')

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | RedStore</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .title{
        margin-right:20px;
        margin-top: 50px;
    }
    .link{
        text-decoration: underline;
        color: blue;
    }
    p{
        cursor: default;
    }
</style>
<body>

<!-- Single Products -->
<div class="small-container single-product">

    <div class="row">
        <div class="col-2">
            <img src="{{ asset('/images/product-10.jpg') }}" width="100%" id="ProductImg">

        </div>
        <div class="col-2">

            <p>Home / {{ $product->category->name }}</p>
            <h1>{{ $product->name }}</h1>
            <h4>${{ $product->price }}</h4>
            <input type="number" value="1">

            <form method="post" action="{{ route('cart.add', ['productId' => $product->id]) }}">
                @csrf
                <button type="submit" class="btn">Add to Cart</button>
            </form>

            <h3>Product Details <i class="fa fa-indent"></i></h3>
            <br>
            <p>{{ $product->description }}</p>
            <br><br><br>
            <p>Store : <a href="{{ route('viewstore', ['store' => $store->id]) }}" class="link">{{ $store->name }}</a></p>
            <a href="{{ route('cart.show')}}">view cart</a>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>
</div>
<!-- title -->
<div class="related-products">
    <h2 class="title">Related Products</h2>
    <div class="row">
        @foreach ($relatedProducts as $relatedProduct)
            <div class="col-4">
                <a href="{{ route('product_details', ['id' => $relatedProduct->id]) }}">
                    <img src="{{ asset('/images/product-10.jpg') }}" alt="Product Image">
                </a>
                <h3>{{ $relatedProduct->name }}</h3>
                <h4>${{ $relatedProduct->price }}</h4>
            </div>
        @endforeach
    </div>
    <!-- Pagination links -->
    <div class="paginate">
        {{ $relatedProducts->links() }}
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

<!-- product gallery -->
<script>
    var ProductImg = document.getElementById("ProductImg");
    var SmallImg = document.getElementsByClassName("small-img");

    SmallImg[0].onclick = function () {
        ProductImg.src = SmallImg[0].src;
    }
    SmallImg[1].onclick = function () {
        ProductImg.src = SmallImg[1].src;
    }
    SmallImg[2].onclick = function () {
        ProductImg.src = SmallImg[2].src;
    }
    SmallImg[3].onclick = function () {
        ProductImg.src = SmallImg[3].src;
    }

</script>
</body>

</html>
@endsection
