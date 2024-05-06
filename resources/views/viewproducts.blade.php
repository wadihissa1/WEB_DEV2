<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Products</title>
    <style>
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
            color: gold; /* Change this to the desired color */
        }
    </style>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <h1>Products for {{ $store->name }}</h1>

    @if($products->count() > 0)
        <div class="product-container">
            @foreach($products as $product)
                <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="product-image">
                    <div class="product-details">
                        <h2>{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p>Price: ${{ $product->price }}</p>
                        <p>Quantity: {{ $product->quantity }}</p>
                        <p>Category: {{ $product->category->name}}</p>
                        <div>
                        <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <form action="{{ route('submitreview') }}" method="POST">
    @csrf
    <!-- Hidden input fields for user_id, store_id, and product_id -->
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
   <!-- <input type="hidden" name="store_id" value="{{ $store->id }}"> -->
    
    <input type="hidden" name="store_id" value="{{ $product->store_id }}">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <label for="rating">Rate the product:</label>
    <div class="stars" id="star-rating-{{ $product->id }}">
    <i class="fa fa-star star" data-value="1"></i>
    <i class="fa fa-star star" data-value="2"></i>
    <i class="fa fa-star star" data-value="3"></i>
    <i class="fa fa-star star" data-value="4"></i>
    <i class="fa fa-star star" data-value="5"></i>
</div>
<input type="hidden" id="rating" name="rating" class="rating-input">

    <label for="comment">Comment:</label>
    <textarea id="comment" name="comment" rows="4" required ></textarea>

    <button type="submit">Submit Review</button>
</form>

<button class="show-reviews-btn">Show Reviews</button>
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
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No products found for this store.</p>
    @endif

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const productContainers = document.querySelectorAll('.product-card');
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
