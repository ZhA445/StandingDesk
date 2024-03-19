<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('home.css')

    <style>
        #search{
            display: none;
        }
    </style>

</head>

<body>
    @include('sweetalert::alert')
    <div class="Background">
        <div class="cont">

            @include('home.header')

            <section>
                <h2 class="cart-header">Shopping Cart</h2>
                <div class="cart-body">
                    <table class="cart-table">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>

                        <?php $total = 0; ?>

                        @foreach ($carts as $cart)
                            <tr>
                                <td class="cart-productsbox">
                                    <div class="cart-img"><img src="/product/{{ $cart->image }}" alt="Product IMG">
                                    </div>
                                    <div class="cart-price">
                                        <span class="cart-text1">{{ $cart->product_title }}</span>
                                        @if ($cart->product_id)
                                            @foreach ($products as $product)
                                                @if ($product->id == $cart->product_id)
                                                    @if ($product->discount_price != null)
                                                        <span>${{ $product->discount_price }}</span>
                                                    @else
                                                        <span>${{ $product->price }}</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @elseif ($cart->shop_product_id)
                                            @foreach ($shopproducts as $product)
                                                @if ($product->id == $cart->shop_product_id)
                                                    @if ($product->discount_price != null)
                                                        <span>${{ $product->discount_price }}</span>
                                                    @else
                                                        <span>${{ $product->price }}</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif

                                        <a href="{{ url("/cart/delete/$cart->id") }}"
                                            onclick="confirmation(event)">Remove</a>
                                    </div>
                                </td>
                                <td><input type="number" value="{{ $cart->quantity }}" readonly></td>
                                <td>${{ $cart->price }}</td>
                            </tr>
                            <?php $total = $total + $cart->price; ?>
                        @endforeach
                    </table>

                    @if (!$carts->isEmpty())
                        <div class="cart-pricebox">

                            <div class="cart-price-text">
                                <span>Subtotal</span>
                                <span>${{ $total }}</span>
                            </div>

                            <div class="cart-price-text">
                                <span>Total</span>
                                <span>${{ $total }}.00</span>
                            </div>

                            <div class="cart-method">
                                <span>Process Method</span>
                                <div class="cart-button-gp">
                                    <a href="{{ url('/order/cash') }}" class="cart-button">Cash on Delivery</a>
                                    <a href="{{ url('stripe', $total) }}" class="cart-button">Pay Using Card</a>
                                </div>
                            </div>

                        </div>
                    @endif



                </div>
            </section>

        </div>

        @include('home.footer')
    </div>

    <script>
        function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            swal({
                title: 'Are you sure to remove!',
                text: "You will not be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willCancel) => {
                if(willCancel){
                    window.location.href = urlToRedirect;
                }
            });
        }

    </script>

</body>

</html>
