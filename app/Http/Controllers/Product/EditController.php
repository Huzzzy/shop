<?php

namespace App\Http\Controllers\Product;

use App\Models\Tag;
use App\Models\Color;
use App\Models\Group;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function __invoke(Product $product)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $colors = Color::all();
        $groups = Group::all();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        return view('product.edit', compact('product', 'tags', 'categories', 'colors', 'productImages', 'groups'));
    }
}
