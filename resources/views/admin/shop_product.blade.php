<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .text {
            font-size: 40px;
            padding: 40px 0;
            text-align: center
        }

        .product_body {
            width: 40%;
            margin: auto;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .product_body input,
        .product_body div select {
            color: #000;
        }

        .product-item{
            margin-bottom: 15px;
        }

        .product-item input {
            color: #000;
        }

        .product-item div{
            display: flex;
            flex-direction: column;
        }

        .product_body div {
            display: flex;
            justify-content: space-between;
        }

        .img_input {
            width: 100px;
            color: #fff;
        }

        .product_body div button {
            margin: auto;
            margin-top: 10px;
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
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session('message') }}
                    </div>
                @endif

                <div class="product_body">
                    <h1 class="text">Add Shop Product</h1>

                    <form action="{{ url('/shop_product/add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="product-item">
                            <label for="title">Product Title</label>
                            <input type="text" name="title" id="title" placeholder="Product Title" required>
                        </div>

                        <div class="product-item">
                            <div>
                                <label for="description">Description</label>
                                <p>[If top collection- type: Top-Collection]</p>
                            </div>
                            <input type="text" name="description" id="description" placeholder="Description">
                        </div>

                        <div class="product-item">
                            <label for="category">Category</label>
                            <select required name="category" id="category">
                                <option selected>Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div class="product-item">

                        <div class="product-item">
                            <label for="quantity">Product Quantity</label>
                            <input type="number" name="quantity" id="quantity" placeholder="Quantity" required>
                        </div>

                        <div class="product-item">
                            <label for="price">Price :</label>
                            <input type="number" name="price" id="price" placeholder="Price" required>
                        </div>

                        <div class="product-item">
                            <label for="dic_price">Discount Price :</label>
                            <input type="number" name="dic_price" id="dic_price" placeholder="Discount Price">
                        </div>

                        <div class="product-item">
                            <label for="image">Product IMG</label>
                            <input type="file" name="image" id="image" class="img_input" required>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
