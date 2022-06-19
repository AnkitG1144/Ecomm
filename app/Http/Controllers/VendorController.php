<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    //
    public function showDashboard(Request $request, Product $product)
    {
        $allProducts = $product->getProductByVendor(Auth::user()->id);
        return view('vendor.dashboard' , compact('allProducts'));
    }

    public function addProduct(Request $request, Product $product)
    {
        if($request->isMethod('get')){
            return view('vendor.addProduct');
        }else if($request->isMethod('post')){

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'productTitle' => 'required',
                'productDescription' => 'required',
                'productprice' => 'required',
                'productOfferPrice' => 'required'
            ]);

            $imageName = uniqid() . '_' .time().'.'.$request->image->extension();  
        
            $request->image->move(public_path('product/images'), $imageName);

            $request->imageName = $imageName;
            $addProduct = $product->createProduct($request);

            return redirect('vendor/dashboard');
        }
    }

    public function changeProductStatus($status, $product_id, Product $product)
    {
        $product->changeProductStatus($status, $product_id);
        return redirect('vendor/dashboard');
    }

}
