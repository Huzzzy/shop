<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Product\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            if (isset($data['tags'], $data['colors'])) {
                $tagsIds = $data['tags'];
                $colorsIds = $data['colors'];
                unset($data['tags'], $data['colors']);
            }

            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }

            $product->update($data);
            if (isset($tagsIds, $colorsIds)) {
                $product->tags()->sync($tagsIds);
                $product->colors()->sync($colorsIds);
            }
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            abort(500);
        }

        return redirect()->route('product.show', compact('product'));
    }
}