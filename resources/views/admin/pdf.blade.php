<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>PDF file</h1>

    <div>Customer Name: <p>{{ $order->name }}</p>
    </div>

    <div>Customer Email: <p>{{ $order->email }}</p>
    </div>

    <div>Customer Phone: <p>{{ $order->phone }}</p>
    </div>

    <div>Customer Address: <p>{{ $order->address }}</p>
    </div>

    <div>Customer Id: <p>{{ $order->user_id }}</p>
    </div>

    <div>Product Name: <p>{{ $order->product_title }}</p>
    </div>

    <div>Price: <p>${{ $order->price }}</p>
    </div>

    <div>uantity: <p>{{ $order->quantity }}</p>
    </div>

    <div>Payment: <p>{{ $order->payment_status }}</p>
    </div>

    <div>Image: </div>
    <img height="200" width="200" src="data:image/png;base64,{{
        base64_encode(file_get_contents($imagePath)) }}" alt="{{ $order->image }}">


</body>

</html>
