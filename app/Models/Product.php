<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'desc', 'image', 'original_price', 'offer_price', 'vendor_id'];
    public $timestamps = true;

    public function createProduct($request)
    {
        $this->title = $request->productTitle;
        $this->desc = $request->productDescription;
        $this->image = $request->imageName;
        $this->original_price = $request->productprice;
        $this->offer_price = $request->productOfferPrice;
        $this->vendor_id = $request->user()->id;
        $this->save();

        return $this;
    }

    public function getProductByVendor($vendor_id)
    {
        return self::select('id','title', 'desc', 'image', 'original_price', 'offer_price', 'is_active')
                    ->where('vendor_id', $vendor_id)
                    ->get();
    }

    public function changeProductStatus($status, $product_id)
    {
        return self::where('id', $product_id)->update([
            'is_active' => $status
        ]);
    }

    public function getAllActiveProduct()
    {
        return self::select('id','title', 'desc', 'image', 'original_price', 'offer_price')
                    ->where('is_active', 1)
                    ->get();
    }

    public function getProductByProductId($product_id)
    {
        return self::select(['id', 'title', 'desc', 'image','original_price', 'offer_price'])
                    ->where('id', $product_id)
                    ->first();
    }
}
