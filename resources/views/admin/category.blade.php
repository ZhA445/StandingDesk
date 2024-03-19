<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text-input{
            color: #000;
            height: 35px;
        }

        table {
            width: 50%;
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

        th,
        td {
            padding: 5px 0;
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

                <div class="text-center">
                    <h2 class="h2_font">Add Category</h2>

                    <form action="{{ url('category/add') }}" method="POST">
                        @csrf
                        <input class="text-input" type="text" name="name" placeholder="Category Name">

                        <input type="submit" value="Add Category" name="submit" class="btn btn-primary">
                    </form>
                </div>

                <table>
                    <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->category_name }}</td>
                            <td><a onclick="return confirm('Are you sure to Delete!')" href="{{url("category/delete/$data->id")}}" class="btn btn-outline-danger">Delete</a></td>
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
