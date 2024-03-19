<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .title {
            font-size: 30px;
            text-align: center;
            margin-bottom: 50px;
        }

        .mail-div {
            width: 30%;
            margin: auto;
            margin-top: 30px;
            align-items: center;
            display: flex;
            justify-content: space-between;
        }

        .mail-div label {
            font-weight: bold;
        }

        .mail-div input {
            margin-left: 20px;
            border-radius: 5px;
            color: #000;
        }

        .mail-btn {
            text-align: center;
            margin-top: 30px;
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
                <h1 class="title">Send Email to {{ $order->email }}</h1>

                @if (session('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session('message') }}
                    </div>
                @endif

                <form action="{{url("/send_user_email/$order->id")}}" method="POST">
                    @csrf
                    <div class="mail-div">
                        <label for="">Email Greeting</label>
                        <input type="text" name="greeting">
                    </div>

                    <div class="mail-div">
                        <label for="">Email First Line</label>
                        <input type="text" name="firstline">
                    </div>

                    <div class="mail-div">
                        <label for="">Email Body</label>
                        <input type="text" name="body">
                    </div>

                    <div class="mail-div">
                        <label for="">Email Button name</label>
                        <input type="text" name="button">
                    </div>

                    <div class="mail-div">
                        <label for="">Email Url</label>
                        <input type="text" name="url">
                    </div>

                    <div class="mail-div">
                        <label for="">Email Last Line</label>
                        <input type="text" name="lastline">
                    </div>

                    <div class="mail-btn">
                        <input type="submit" value="Send Email" class="btn btn-primary email-btn">
                    </div>
                </form>

            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
