<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('home.css')
    <style>
        #search {
            display: none;
        }
        .title {
            font-size: 30px;
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
            font-weight: bold;
        }

        section {
            width: 100%;
            padding-bottom: 50px;
        }

        table {
            width: 100%;
            margin: auto;
            text-align: center;
        }

        .order-table tr th{
            background: #ffa31a;
        }

        .order-table,
        .order-table tr th,
        .order-table tr td {
            border: 1px solid #fff;
            color: #fff;
            padding: 4px 0;
        }

        .product-img {
            width: 100px;
            height: 100px;
            margin: auto;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div class="Background">
        <div class="cont">

            @include('home.header')

            <section>
                <h1 class="title">Order Products</h1>

                <table class="order-table">
                    <tr>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Deliver Status</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->product_title }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>${{ $order->price }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->delivary_status }}</td>
                            <td>
                                <img src="/product/{{ $order->image }}" alt="" class="product-img">
                            </td>
                            <td>
                                @if ($order->delivary_status=="processing")
                                    <a href="{{ url("/orders/cancel/{$order->id}") }}" class="btn btn-outline-danger"
                                        onclick="confirmation(event)">Cancel</a>
                                @else
                                    <p class="text-danger">Not Allowed</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>

            </section>

        </div>

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
