<?php

namespace App\Http\Controllers\Product;

use App\Models\Tag;
use App\Models\Color;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;

class CreateController extends Controller
{
    public function __invoke()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $colors = Color::all();
        $groups = Group::all();
        return view('product.create', compact('tags', 'categories', 'colors', 'groups'));
    }
}
