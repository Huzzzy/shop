<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'required|file',
            'product_images' => 'nullable|array',
            'price' => 'required|integer',
            'count' => 'required|integer|max:1264',
            'is_published' => 'nullable',
            'category_id' => 'nullable|integer|exists:categories,id',
            'group_id' => 'nullable|integer|exists:groups,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|integer|exists:tags,id',
            'colors' => 'nullable|array',
            'colors.*' => 'nullable|integer|exists:colors,id',
        ];
    }
}
