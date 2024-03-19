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
            width: 30%;
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

        .product_body div {
            margin-bottom: 10px;
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
                    <h1 class="text">Update Shop Product</h1>

                    <form action="{{ url("/shop_product/edit/$product->id") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="title">Product Title</label>
                            <input type="text" name="title" id="title" placeholder="Product Title" required
                                value="{{ $product->title }}">
                        </div>

                        <div>
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" placeholder="Description" required
                                value="{{ $product->description }}">
                        </div>

                        <div>
                            <label for="category">Category</label>
                            <select required name="category" id="category">
                                <option selected value="{{ $product->category }}">{{ $product->category }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="quantity">Product Quantity</label>
                            <input type="number" name="quantity" id="quantity" placeholder="Quantity" required
                                value="{{ $product->quantity }}">
                        </div>

                        <div>
                            <label for="price">Price :</label>
                            <input type="number" name="price" id="price" placeholder="Price" required
                                value="{{ $product->price }}">
                        </div>

                        <div>
                            <label for="dic_price">Discount Price :</label>
                            <input type="number" name="dic_price" id="dic_price" placeholder="Discount Price"
                                value="{{ $product->discount_price }}">
                        </div>

                        <div>
                            <label for="image">Current Product IMG</label>
                            <img width="200" height="200" src="/product/{{ $product->image }}" alt="Prduct IMG">
                        </div>

                        <div>
                            <label for="image">Product IMG</label>
                            <input type="file" name="image" id="image" class="img_input">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Update Product</button>
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
