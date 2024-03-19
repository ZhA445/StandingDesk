<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShopProducts;
use App\Notifications\SendEmailNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Notification;


class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function view_category(){

        $data = Category::all();

        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new Category;

        $data->category_name = $request->name;

        $data->save();

        return redirect()->back()->with('message', 'Category Added');
    }

    public function delete_category($id)
    {
        $data = Category::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Category Deleted');
    }

    public function view_product()
    {
        $categories = Category::all();

        return view('admin.product', compact('categories'));

    }
    public function view_shop_product()
    {
        $categories = Category::all();

        return view('admin.shop_product', compact('categories'));
    }

    public function add_product(Request $request)
    {
        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->dic_price;

        $image = $request->image;

        $imagename = time(). '.' .$image->getClientOriginalExtension();

        $request->image->move('product', $imagename);

        $product->image  = $imagename;

        $product->save();

        return redirect()->back()->with('message','Product Added');
    }

    public function add_shop_product(Request $request)
    {
        $product = new ShopProducts;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->dic_price;

        $image = $request->image;

        $imagename = time(). '.' .$image->getClientOriginalExtension();

        $request->image->move('product', $imagename);

        $product->image  = $imagename;

        $product->save();

        return redirect()->back()->with('message', 'Prdouct Added');
    }

    public function show_product()
    {
        $products = Product::all();

        return view('admin.show_product',compact('products'));
    }

    public function show_shop_product()
    {
        $products = ShopProducts::all();

        return view('admin.show_shop_product',compact('products'));
    }

    public function delete_product($id)
    {
        $data = Product::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Product Deleted!');
    }

    public function delete_shop_product($id)
    {
        $data = ShopProducts::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Product Deleted!');
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('admin.edit_product',compact('product','categories'));
    }

    public function edit_shop_product($id)
    {
        $product = ShopProducts::find($id);
        $categories = Category::all();

        return view('admin.edit_shop_product',compact('product','categories'));
    }

    public function update_product($id, Request $request)
    {
        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->dic_price;

        $image = $request->image;

        if($image)
        {
            $imagename = time(). '.' . $image->getClientOriginalExtension();

            $request->image->move('product', $imagename);

            $product->image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product Updated');

    }
    public function update_shop_product($id, Request $request)
    {
        $product = ShopProducts::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->dic_price;

        $image = $request->image;

        if($image)
        {
            $imagename = time(). '.' . $image->getClientOriginalExtension();

            $request->image->move('product', $imagename);

            $product->image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product Updated');
    }

    public function orders()
    {
        $orders = Order::all();

        return view('admin.order',compact('orders'));
    }

    public function delivered($id)
    {
        $order = Order::find($id);

        $order->delivary_status = "delivered";

        $order->payment_status = "Paid";

        $order->save();

        return redirect()->back();
    }

    public function print_pdf($id)
    {
        $order = Order::find($id);

        $imagePath = public_path("/product/$order->image");

        $dompdf = new Dompdf;
        $dompdf->set_option('isHtml5ParserEnabled',true);
        $dompdf->set_option('isRemoteEnabled',true);

        $dompdf->loadHtml(view('admin.pdf',compact('order','imagePath'))->render());

        $dompdf->render();

        return $dompdf->stream('order_deails.pdf');

    }

    public function send_email($id)
    {
        $order = Order::find($id);

        return view('admin.send_email',compact('order'));
    }

    public function send_user_email($id,Request $request)
    {
        $order = Order::find($id);

        $details = [
            'greeting' => $request->greeting,

            'firstline' => $request->firstline,

            'body' => $request->body,

            'button' => $request->button,

            'url' => $request->url,

            'lastline' => $request->lastline,
        ];

        Notification::send($order,new SendEmailNotification($details));

        return redirect()->back()->with('message', 'Email Send Successful.');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $orders = Order::where('name','LIKE',"%$search%")->orWhere('phone','LIKE',"%$search%")->orWhere('product_title','LIKE',"%$search%")->get();

        return view('admin.order',compact('orders'));
    }


}
