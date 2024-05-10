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
    .col-4 img {
    height: 440px;
}
            justify-content: end;
            margin-right: 20px;
        }

        .container_head {
            background-color: #00000090;
            padding: 45px;
        }

        .product-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
            width: 300px;
        }

        .product-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .product-details {
            margin-top: 12px;
        }

        .product-details h2 {
            margin-bottom: 8px;
        }

        .product-details p {
            margin: 0;
        }

        .fas {
            color: gold;
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
        <div>
            <div class="row">
                <h1>Newest Releases:</h1>
                @foreach ($products as $product)
                <div class="col-4">
                    <a href="/viewstore/{{ $product->id }}"><img src="{{ asset('images/product-1.jpg') }}"></a>
                    <center>
                        <h3>{{ $product->name }}</h3>
                    </center>
                    <!-- Review Form -->
                    <form action="{{ route('submitreview') }}" method="POST" class="review-form">
                        @csrf
                        <!-- Hidden input fields for user_id, store_id, and product_id -->
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="store_id" value="{{ $store->id }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <!-- Rating stars -->
                        <label for="rating">Rate the product:</label>
                        <div class="stars" id="star-rating-{{ $product->id }}">
                            <i class="fa fa-star star" data-value="1"></i>
                            <i class="fa fa-star star" data-value="2"></i>
                            <i class="fa fa-star star" data-value="3"></i>
                            <i class="fa fa-star star" data-value="4"></i>
                            <i class="fa fa-star star" data-value="5"></i>
                        </div>
                        <input type="hidden" id="rating" name="rating" class="rating-input">
                        <!-- Comment textarea -->
                        <label for="comment">Comment:</label>
                        <textarea id="comment" name="comment" rows="4" required></textarea>
                        <!-- Submit button -->
                        <button type="submit">Submit Review</button>
                    </form>
                    <!-- Show Reviews button -->
                    <button class="show-reviews-btn">Show Reviews</button>
                    <!-- Reviews container -->
                    <div class="reviews-container">
                        <!-- Display existing reviews if any -->
                        @foreach($product->reviews as $review)
                        <div>
                            <p>Rating: {{ $review->rating }}</p>
                            <p>Comment: {{ $review->comment }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="paginate">
            {{ $products->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productContainers = document.querySelectorAll('.col-4');
            productContainers.forEach(container => {
                const stars = container.querySelectorAll('.star');
                const ratingInput = container.querySelector('.rating-input');
                stars.forEach(star => {
                    star.addEventListener('mouseover', function () {
                        const value = this.dataset.value;
                        highlightStars(stars, value);
                    });
                    star.addEventListener('click', function () {
                        const value = this.dataset.value;
                        ratingInput.value = value;
                        highlightStars(stars, value);
                    });
                });
            });

            function highlightStars(stars, value) {
                stars.forEach(star => {
                    if (star.dataset.value <= value) {
                        star.classList.remove('far');
                        star.classList.add('fas');
                    } else {
                        star.classList.remove('fas');
                        star.classList.add('far');
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const showReviewsButtons = document.querySelectorAll('.show-reviews-btn');
            showReviewsButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const reviewsContainer = this.nextElementSibling;
                    reviewsContainer.style.display = reviewsContainer.style.display === 'none' ? 'block' : 'none';
                });
            });
        });
    </script>
</body>

</html>
@endsection
