<?php

namespace App\Http\Controllers\Product;

use App\Models\Tag;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function __invoke(Product $product)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $colors = Color::all();
        return view('product.edit', compact('product', 'tags', 'categories', 'colors'));
    }
}