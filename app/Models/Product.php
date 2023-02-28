<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    const IS_PUBLISHED_TRUE = 1;
    const IS_PUBLISHED_FALSE = 0;

    protected $table = 'products';
    protected $guarded = false;

    static function getIsPublished()
    {
        return [
            self::IS_PUBLISHED_TRUE => 'Да',
            self::IS_PUBLISHED_FALSE => 'Нет',
        ];
    }

    public function getIsPublishedTitleAttribute()
    {
        return self::getIsPublished()[$this->is_published];
    }

    public function getImageUrlAttribute()
    {
        return url('storage/' . $this->preview_image);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_products', 'product_id', 'color_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
