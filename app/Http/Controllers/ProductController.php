<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()

    {

        $products = Product::all();

        return view('products', compact('products'));

    }
    public function cart()

    {

        return view('cart');

    }
    public function addToCart($id)

    {

        $product = Product::findOrFail($id);

          

        $cart = session()->get('cart', []);

  

        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [

                "name" => $product->name,

                "quantity" => 1,

                "price" => $product->price,

                "image" => $product->image

            ];

        }

          

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
    public function update(Request $request)

    {

        if($request->id && $request->quantity){

            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');

        }

    }


 public function remove(Request $request)

    {

        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);

            }

            session()->flash('success', 'Product removed successfully');

        }

    }
}
