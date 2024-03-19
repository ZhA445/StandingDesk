<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .title {
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin: auto;
            text-align: center;
        }

        table th {
            background: #ffa31a;
        }

        table tr,
        th,
        td {
            border: 1px solid #fff;
        }

        th,
        td {
            padding: 5px 0;
        }

        .product-img {
            width: 100px;
            height: 100px;
            margin: auto;
        }

        td p{
            color: #ffa31a;
        }

        .search-form{
            text-align: center;
            align-items: center;
            margin-bottom: 30px;
        }

        .search-form .search{
            width: 20%;
            height: 30px;
            color: #000;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="title">Orders</h1>

                <div class="search-form">
                    <form action="{{url('/search')}}" method="GET">
                        @csrf
                        <input type="text" name="search" class="search" placeholder="Search Products">

                        <input type="submit" value="Search" class="btn btn-outline-primary">
                    </form>
                </div>

                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Deliver Status</th>
                        <th>Image</th>
                        <th>Delivered</th>
                        <th>Print</th>
                        <th>Send Email</th>

                    </tr>

                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->product_title }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>${{ $order->price }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ $order->delivary_status }}</td>
                            <td>
                                <img class="product-img" src="/product/{{ $order->image }}" alt="Product IMG">
                            </td>
                            <td>
                                @if ($order->delivary_status == 'processing')
                                    <a href="{{ url("/orders/$order->id/delivered") }}"
                                        class="btn btn-primary" onclick="return confirm('Ready to Deliver?')">Deliver</a>
                                @else
                                    <p>Deliver</p>
                                @endif
                            </td>

                            <td>
                                <a href="{{url("/orders/$order->id/print/")}}" class="btn btn-secondary">PDF</a>
                            </td>
                            <td>
                                <a href="{{url("/send_email/$order->id")}}" class="btn btn-info">Send</a>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="16">
                                No Data Found
                            </td>
                        </tr>

                    @endforelse
                </table>


            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
