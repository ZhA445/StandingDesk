<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            color: #fff;
        }

        #search{
            display: none;
        }

        .home-product {
            width: 70%;
            margin: auto;
            margin-bottom: 30px;
        }

        .home-product .product-img {
            width: 30%;

        }

        .product-price-gp {
            width: 40%;
            margin: auto;
            margin-top: 20px;
        }

        .card-text {
            margin-top: 5px;
        }

        .product-shop {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-shop .qty {
            color: #000;
            margin-top: 20px;
            width: 100px;
            border-radius: 5px;
            padding: 3px 5px;
        }

        .product-shop .product-btn {
            background-color: rgb(212, 139, 3);
        }

        .cmt-section {
            margin-top: 20px;
        }

        .cmt-title {
            font-size: 20px;
            font-weight: bold;
            margin: 30px 0;
        }

        .cmt-section {
            text-align: start;
            width: 50%;
            margin: auto;
        }

        .cmt-area {
            width: 100%;
            margin-bottom: 15px;
            border-radius: 5px;
            color: #000;
        }

        .all-cmt {
            margin-bottom: 20px;
        }

        .cmt-form {
            text-align: center;
        }

        .cmt-item {
            margin-bottom: 5px;
        }

        .cmt-item span,
        .reply-div span {
            font-size: 13px;
        }

        .reply-div {
            padding-left: 3%;
            padding-bottom: 5px;
        }

        .all-reply {
            width: 70%;
            display: none;
            margin: 5px 0;
        }

        .all-reply textarea {
            width: 100%;
            border-radius: 5px;
            height: 50px;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="Background">
        <div class="cont">

            @include('home.header')

            <div class="home-product">
                <img src="/product/{{ $product->image }}" alt="Product IMG" class="product-img">
                <div class="product-text ">
                    <span>{{ $product->title }}</span>
                    <p class="card-text text-white">{{ $product->description }}</p>

                    <p class="card-text">Category: {{ $product->category }}</p>

                    <p class="card-text">Available Quantity: {{ $product->quantity }}</p>

                    <div class="product-price-gp">
                        @if ($product->discount_price != null)
                            <p class="card-subtitle">Discount: ${{ $product->discount_price }}</p>

                            <p class="card-subtitle" style="text-decoration: line-through; color:red">
                                ${{ $product->price }}
                            </p>
                        @else
                            <p class="card-subtitle">${{ $product->price }}</p>
                        @endif
                    </div>

                    <form action="{{ url("/shop_products/$product->id/cart") }}" method="post" class="product-shop">
                        @csrf
                        <input type="number" name="quantity" value="1" class="qty">
                        <input type="submit" class="btn product-btn" value="Add to Cart">
                    </form>

                </div>

            </div>

        </div>

        @include('home.footer')
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>

</body>

</html>
