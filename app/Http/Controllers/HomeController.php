<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Cart;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function home()
    {
        $product = product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
        }
       else{
            $count = '';
       }

        return view('home.index', compact('product', 'count'));
    }

    public function login_home()
    {
        $product = product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
        }
       else{
            $count = '';
       }

        return view('home.index', compact('product', 'count'));
    }

    //create for product details
    public function product_details($id)
    {
        $data = Product::find($id);

        if(Auth::id())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count();
        }
       else{
            $count = '';
       }

        return view('home.product_details', compact('data', 'count'));
    }

    //create for add cart
    public function add_cart($id)
    {
       $product_id = $id;
       $user= Auth::user();
       $user_id = $user->id;
       $data = new Cart;
       $data->user_id = $user_id;
       $data->product_id = $product_id;
       $data->save();
       return redirect()->back();

       
    }

    public function mycart()
    {

        if(Auth::id())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $count = Cart::where('user_id', $user_id)->count(); 
            $cart = Cart::where('user_id', $user_id)->get();
        }
        return view('home.mycart', compact('count', 'cart'));
    }

    public function remove_cart($id)
{
    $cart = Cart::find($id);
    if ($cart) {
        $cart->delete();
    }
    return redirect()->back();
}

}
