@extends('layout')
@section('content')

    

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedStore | Ecommerce Website Design</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
 <div class="header" style="margin-top: -70px">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <h1>Give Your Workout <br> A New Style!</h1>
                    <p>Success isn't always about greatness. It;s about consistency. Consistent <br> hard work gains
                        success. Greatness will come.</p>
                    <a href="" class="btn">Explore Now &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="images/image1.png">
                </div>
            </div>
        </div>
    </div>
<!-- Feadtued stores  -->

<div class="categories">
    <h2 class="title">Featured Stores</h2>
    <div class="small-container">
        <div class="row">

            @foreach ($userStore as $store)

            <div class="col-4">
                <a href="/viewstore/{{ $store->id }}"><img src="images/product-1.jpg"></a>
                <center><h3>{{ $store->name }}</h3></center>
            </div>
                
            @endforeach
        </div>
    </div>
    <div class="paginate">
        {{$userStore->links()}}
    </div>
</div>

<!-- Featured Products -->

<div>
    <h2 class="title">Featured Products</h2>
    
    <div class="row">
        @foreach ($randomProducts as $product)
        <div class="col-4">
            <a href="/product_details/{{ $product->id }}"><img src="images/product-1.jpg"></a>
            <h4>{{ $product->name }}</h4>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <p>$ {{ $product->price }}</p>
            <p>Qty: {{ $product->quantity }}</p>
        </div>
        @endforeach
    </div>
    <div class="paginate">
        {{$randomProducts->links()}}
    </div>
</div> 

<!-- Offer -->
<div class="offer">
    <div>
        <div class="row">
            <div class="col-2">
                <img src="images/exclusive.png" class="offer-img">
            </div>
            <div class="col-2">
                <p>Exclusively Available on RedStore</p>
                <h1>Smart Band 4</h1>
                <small>The Mi Smart Band 4 fearures a 39.9%larger (than Mi Band 3) AMOLED color full-touch display
                    with adjustable brightness, so everything is clear as can be.<br></small>
                <a href="products.html" class="btn">Buy Now &#8594;</a>
            </div>
        </div>
    </div>
</div>

<!-- Testimonial -->
<div class="testimonial">
    <div class="small-container">
        <div class="row">
            <div class="col-3">
                <i class="fa fa-quote-left"></i>
                <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    industry's standard dummy text.</p>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <img src="images/user-1.png">
                <h3>Sean Parker</h3>
            </div>
            <div class="col-3">
                <i class="fa fa-quote-left"></i>
                <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    industry's standard dummy text.</p>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <img src="images/user-2.png">
                <h3>Mike Smith</h3>
            </div>
            <div class="col-3">
                <i class="fa fa-quote-left"></i>
                <p>Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    industry's standard dummy text.</p>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <img src="images/user-3.png">
                <h3>Mabel Joe</h3>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->

<div class="brands">
    <div class="small-container">
        <div class="row">
            <div class="col-5">
                <img src="images/logo-godrej.png">
            </div>
            <div class="col-5">
                <img src="images/logo-oppo.png">
            </div>
            <div class="col-5">
                <img src="images/logo-coca-cola.png">
            </div>
            <div class="col-5">
                <img src="images/logo-paypal.png">
            </div>
            <div class="col-5">
                <img src="images/logo-philips.png">
            </div>
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
        }
        else {
            MenuItems.style.maxHeight = "0px"
        }
    }
</script>

</body>

</html>
@endsection