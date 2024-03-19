<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .product_head {
            text-align: center;
            font-size: 40px;
        }

        table {
            width: 90%;
            margin: auto;
            text-align: center;
            margin-top: 30px;
            border-collapse: collapse;
        }

        table th {
            background: #ffa31a;
        }

        tr,
        th,
        td {
            border: 1px solid #fff;
        }

        th {
            padding: 10px 0;

        }



        .product_img {
            width: 200px;
            height: 200px;
            margin: auto;
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

                @if (session('message'))
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session('message') }}
                    </div>
                @endif

                <h1 class="product_head">All Shop Products</h1>
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category }}</td>
                            <td>${{ $product->price }}</td>
                            @if ($product->discount_price != null)
                                <td>${{ $product->discount_price }}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>
                                <img class="product_img" src="/product/{{ $product->image }}" alt="Products IMG">
                            </td>
                            <td class="product_btn_gp">
                                <a href="{{ url("/shop_product/edit/$product->id") }}" class="btn btn-warning">Edit</a>
                                <a onclick="return confirm('Are you sure to Delete?')"
                                    href="{{ url("/shop_product/delete/$product->id") }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
