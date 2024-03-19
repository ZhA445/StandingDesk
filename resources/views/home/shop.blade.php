<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>


        @media(max-width:425px){
            .nav-bar{
                display: flex;
                justify-content: end
            }
            .logo-group{
            display: none;
        }
        }
    </style>
</head>



<body>
    @include('sweetalert::alert')
    <div class="Background">
        <div class="cont">

            @include('home.header')

            <section>
                <div class="shop-body">
                    <h2 class="shop-head">Shop Here</h2>
                    <div class="shop-slideshow">
                        <div class="slideshow-part">
                            <img src="{{asset('./images/slide1.jpg')}}" alt="Standing Desks Photo">
                            <img src="{{asset('./images/slide2.jpg')}}" alt="Standing Desks Photo">
                            <img src="{{asset('./images/slide3.jpg')}}" alt="Standing Desks Photo">
                            <img src="{{asset('./images/slide4.jpg')}}" alt="Standing Desks Photo">
                            <img src="{{asset('./images/slide5.jpg')}}" alt="Standing Desks Photo">

                        </div>
                    </div>

                    @if (!isset($products))
                    <div class="shop-items-gp">
                        <div class="shop-collection">collection</div>
                        <div class="shop-line"></div>
                        <div class="shop-top-collection">Our Top Colleciton</div>
                        <div class="shop-items">
                            @foreach ($topproducts as $topproduct)
                                <div class="shop-item">
                                    <div>
                                        <img src="/product/{{ $topproduct->image }}" alt="{{ $topproduct->image }}">
                                        <div class="shop-item-text">
                                            <span>{{ $topproduct->title}}</span>
                                            <div class="product-price-gp">
                                                @if ($topproduct->discount_price != null)
                                                    <p class="card-subtitle">${{ $topproduct->discount_price }}
                                                    </p>
                                                    <p class="card-subtitle"
                                                        style="text-decoration: line-through; color:red;">
                                                        {{ $topproduct->price }}</p>
                                                @else
                                                    <p class="card-subtitle">${{ $topproduct->price }}</p>
                                                @endif
                                            </div>
                                            <a href="{{ url("/shop_product/detail/$topproduct->id") }}"
                                                class="item-price">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="shop-items-gp">
                        <div class="shop-categories">categories</div>
                        <div class="shop-line"></div>
                        <div class="shop-leatest-collection">2024 Latest Collections</div>
                        {{-- {{$leatproducts->links()}} --}}
                        <div class="collection-items">
                            @foreach ($leatproducts as $leatproduct)
                                <div class="collection-item">
                                    <div>
                                        <img src="/product/{{ $leatproduct->image }}" alt="{{$leatproduct->title}}">
                                        <div class="collection-item-text">
                                            <span>{{ $leatproduct->title }}</span>
                                            <div class="product-price-gp">
                                                @if ($leatproduct->discount_price != null)
                                                    <p class="card-subtitle">${{ $leatproduct->discount_price }}
                                                    </p>
                                                    <p class="card-subtitle"
                                                        style="text-decoration: line-through; color:red;">
                                                        {{ $leatproduct->price }}</p>
                                                @else
                                                    <p class="card-subtitle">${{ $leatproduct->price }}</p>
                                                @endif
                                            </div>
                                            <a href="{{ url("/shop_product/detail/$leatproduct->id") }}"
                                                class="item-price">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="collection-btn">Load More ></div>
                    </div>
                    @endif

                    @if (isset($products))
                    <div class="shop-leatest-collection">Products</div>
                    <div class="shop-line"></div>
                        <div class="collection-items">
                            @foreach ($products as $product)
                                <div class="collection-item">
                                    <div>
                                        <img src="/product/{{ $product->image }}" alt="Dual-Monitor Arm">
                                        <div class="collection-item-text">
                                            <span>{{ $product->title }}</span>
                                            <div class="product-price-gp">
                                                @if ($product->discount_price != null)
                                                    <p class="card-subtitle">${{ $product->discount_price }}
                                                    </p>
                                                    <p class="card-subtitle"
                                                        style="text-decoration: line-through; color:red;">
                                                        {{ $product->price }}</p>
                                                @else
                                                    <p class="card-subtitle">${{ $product->price }}</p>
                                                @endif
                                            </div>
                                            <a href="{{ url("/shop_product/detail/$product->id") }}"
                                                class="item-price">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif




                </div>
            </section>

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
