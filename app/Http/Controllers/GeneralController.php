<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GeneralController extends Controller
{

    public function welcomeIndex(Request $request, Product $product)
    {
        $allProducts = $product->getAllActiveProduct();
        return view('welcome', compact('allProducts'));
    }

    public function viewProductDetails(Product $product, $product_id)
    {   
        $productDetail = $product->getProductByProductId($product_id);
        return view('viewProduct', compact('productDetail'));
    }

    public function addToCart(Request $request, $product_id)
    {
        $product = Product::find($product_id);
        $cart = session()->get('cart');
        if(!$cart) {
            $cart = [
                    $product_id => [
                        "name" => $product->title,
                        "quantity" => 1,
                        "original_price" => $product->original_price,
                        "offer_price" => $product->offer_price,
                        "photo" => $product->image
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        if(isset($cart[$product_id])) {
            $cart[$product_id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        $cart[$product_id] = [
            "name" => $product->title,
            "quantity" => 1,
            "original_price" => $product->original_price,
            "offer_price" => $product->offer_price,
            "photo" => $product->image
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function cart()
    {
        return view('cart');
    }

    public function deleteCart($product_id)
    {
        if($product_id) {
            $cart = session()->get('cart');
            if(isset($cart[$product_id])) {
                unset($cart[$product_id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Product removed successfully');
        }
    }

    public function buyNow(Request $request)
    {
        if(!Auth::guard('web')->check())
           return redirect()->back()->with('danger', 'Please Login to Purchase'); 
        else
            return redirect()->back()->with('success', 'Order Successfully Placed');
    }
}
