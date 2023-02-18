<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Product\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

            if (isset($data['tags'], $data['colors'])) {
                $tagsIds = $data['tags'];
                $colorsIds = $data['colors'];
                unset($data['tags'], $data['colors']);
            }

            $product = Product::create($data);

            if (isset($tagsIds, $colorsIds)) {
                $product->tags()->attach($tagsIds);
                $product->colors()->attach($colorsIds);
            }

            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();

            abort(500);
        }

        return redirect()->route('product.index');
    }
}