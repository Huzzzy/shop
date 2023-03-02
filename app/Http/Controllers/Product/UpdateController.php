<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\ProductImage;
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

            if (isset($data['tags'], $data['colors'], $data['product_images'])) {
                $tagsIds = $data['tags'];
                $colorsIds = $data['colors'];
                $productImages = $data['product_images'];
                unset($data['tags'], $data['colors'], $data['product_images']);
            }

            if (isset($data['preview_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }

            $product->update($data);

            $currentImages = ProductImage::where('product_id', $product->id)->get();

            $imagesData = [];

            if (isset($productImages)) {
                foreach ($productImages as $productImage) {
                    $count = ProductImage::where('product_id',  $product->id)->count();

                    if ($count > 3) continue;

                    $filePath = Storage::disk('public')->put('/images', $productImage);
                    $data = [
                        'product_id' => $product->id,
                        'file_path' => $filePath,
                    ];
                    $imagesData[] = $data;

                }
            }
            if(isset($imagesData)) {
                $tmp = 0;
                foreach ($currentImages as $currentImage ) {
                    $currentImage->update($imagesData[$tmp]);
                    $tmp++;
                }
            }

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
