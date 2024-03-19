<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use App\Models\ShopProducts;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;

use Session;
use Stripe;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'deatil_product','googlepage','googlecallback');
    }

    public function index()
    {

        $products = Product::paginate(6);

        return view('home.userpage', compact('products'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            $total_product1 = Product::all()->count();
            $total_product2 = ShopProducts::all()->count();

            $total_products = $total_product1+ $total_product2;

            $total_orders = Order::all()->count();
            $total_users = User::all()->count();
            $orders = Order::all();

            $total_revenue = 0;
            foreach ($orders as $order) {
                $total_revenue = $total_revenue + $order->price;
            }

            $total_delivered = Order::where('delivary_status', '=', 'delivered')->get()->count();

            $total_processing = Order::where('delivary_status', '=', 'processing')->get()->count();

            return view('admin.home', compact('total_products', 'total_orders', 'total_users', 'total_revenue', 'total_delivered', 'total_processing'));
        } else {
            $products = Product::paginate(6);

            return view('home.userpage', compact('products'));
        }
    }

    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        try{
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id',$user->id)->first();

            if($finduser)
            {
                Auth::login($finduser);


                return redirect()->intended('redirect');
            }
            else
            {
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'google_id' => $user->id,
                    'user_type' => '0',
                    'email_verified_at' => now(),
                ]);

                Auth::login($newUser);

                return redirect('/redirect');
            }
        } catch(Exception $e){
            return redirect('/login');
        }
    }

    public function detail_product($id)
    {
        $product = Product::find($id);

        $comments = Comment::where('product_id', $id)->orderBy('id', 'desc')->get();

        $replies = Reply::all();

        return view('home.product_detail', compact('product', 'comments', 'replies'));
    }

    public function add_cart($id, Request $request)
    {
        $user = Auth::user();
        $userid = $user->id;
        $product = Product::find($id);

        $product_exit_id = Cart::where('product_id', $id)->where('user_id', $userid)->get('id')->first();

        if ($product_exit_id)
        {
            $cart= Cart::find($product_exit_id)->first();

            $quantity = $cart->quantity;

            $cart->quantity = $quantity + $request->quantity;

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $cart->quantity;
            } else {
                $cart->price = $product->price * $cart->quantity;
            }

            $cart->save();

            Alert::success('Product Added Success', 'We have added product to the cart');

            return redirect('/redirect');


        } else {
            $cart = new Cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->product_title = $product->title;
            $cart->quantity = $request->quantity;

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->user_id = $user->id;

            $cart->save();

            Alert::success('Product Added Success', 'We have added product to the cart');

            return redirect('/redirect');
        }

    }

    public function add_shop_cart($id, Request $request)
    {
        $user = Auth::user();
        $userid = $user->id;
        $product = ShopProducts::find($id);

        $product_exit_id = Cart::where('shop_product_id', $id)->where('user_id', $userid)->get('id')->first();

        if ($product_exit_id)
        {
            $cart= Cart::find($product_exit_id)->first();

            $quantity = $cart->quantity;

            $cart->quantity = $quantity + $request->quantity;

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $cart->quantity;
            } else {
                $cart->price = $product->price * $cart->quantity;
            }

            $cart->save();
            Alert::success('Product Added Success', 'We have added product to the cart');

            return redirect('/shop');


        } else {
            $cart = new Cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->product_title = $product->title;
            $cart->quantity = $request->quantity;

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {
                $cart->price = $product->price * $request->quantity;
            }

            $cart->image = $product->image;
            $cart->shop_product_id = $product->id;
            $cart->user_id = $user->id;

            $cart->save();
            Alert::success('Product Added Success', 'We have added product to the cart');

            return redirect('/redirect');
        }

    }

    public function show_cart()
    {
        $id = Auth::user()->id;

        $carts = Cart::where('user_id', $id)->get();

        if($carts->isEmpty()){
            return redirect('/');
        }

        $productIds = Cart::where('user_id', $id)->pluck('product_id');

        $shopporductIds = Cart::where('user_id',$id)->pluck('shop_product_id');

        $products = Product::whereIn('id', $productIds)->get();

        $shopproducts = ShopProducts::whereIn('id',$shopporductIds)->get();

        return view('home.cart', compact('carts', 'products','shopproducts'));
    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);

        $cart->delete();

        return redirect()->back();
    }

    public function cash_order()
    {
        $user = Auth::user();

        $userid = $user->id;

        $data = Cart::where('user_id', $userid)->get();

        foreach ($data as $data) {

            $order = new Order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            if($data->product_id){
                $order->product_id = $data->product_id;
            }
            else{
                $order->product_id = $data->shop_product_id;
            }
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->quantity = $data->quantity;

            $order->payment_status = 'cash on delivery';

            $order->delivary_status = 'processing';

            $order->save();

            $cart_id = $data->id;

            $cart = Cart::find($cart_id);

            $cart->delete();
        }

        Alert::success('We have Received your Order.', 'We will connect soon...');

        return redirect('/');

    }

    public function stripe($total)
    {
        return view('home.stripe', compact('total'));
    }

    public function stripePost(Request $request, $total)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thank For Payment."
        ]);


        $user = Auth::user();

        $userid = $user->id;

        $data = Cart::where('user_id', $userid)->get();

        foreach ($data as $data) {

            $order = new Order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_id = $data->product_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->quantity = $data->quantity;

            $order->payment_status = 'Paid';

            $order->delivary_status = 'processing';

            $order->save();

            $cart_id = $data->id;

            $cart = Cart::find($cart_id);

            $cart->delete();
        }



        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function show_order()
    {
        $userid = Auth::user()->id;

        $orders = Order::where('user_id', $userid)->get();

        if($orders->isEmpty()){
            return redirect('/');
        }

        return view('home.show_order', compact('orders'));
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);

        $order->delete();

        Alert::warning('Order Cancled!');

        return redirect()->back();
    }

    public function add_comment($id, Request $request)
    {

        $user = Auth::user();

        $comment = new Comment;

        $comment->name = $user->name;
        $comment->comment = $request->comment;
        $comment->user_id = $user->id;
        $comment->product_id = $id;

        $comment->save();

        return redirect()->back();

    }

    public function add_reply(Request $request)
    {
        $user = Auth::user();

        $reply = new Reply;

        $reply->name = $user->name;
        $reply->comment_id = $request->commentId;
        $reply->reply = $request->reply;
        $reply->user_id = $user->id;

        $reply->save();

        return redirect()->back();

    }


    public function product_search(Request $request)
    {
        $search_text = $request->search;

        $products = ShopProducts::where('title', 'LIKE', "%$search_text%")->orwhere('category', 'LIKE', "$search_text")->paginate(8);

        if($search_text){
            return view('home.shop', compact('products'));
        }
        return redirect()->back();

    }

    public function shop()
    {
        $topproducts = ShopProducts::where('description','LIKE','Top-Collection')->get();

        $leatproducts = ShopProducts::where('description',null)->get();

        return view('home.shop', compact('topproducts','leatproducts'));
    }

    public function detail_shop_product($id){

        $product = ShopProducts::find($id);

        return view('home.shop_product_detail',compact('product'));
    }

    public function benefit()
    {
        return view('home.benefit');
    }

    public function contact()
    {
        return view('home.contact');
    }
}
