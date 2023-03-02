<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        $productImages = ProductImage::where('product_id', $product->id)->get();
        return view('product.show', compact('product', 'productImages'));
    }
}
