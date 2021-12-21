<?php

namespace App;

use App\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function productSize()
    {
        return $this
            ->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id')
            ->withTimestamps();
    }

    public function tags()
    {
        return $this
            ->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')
            ->withTimestamps();
    }
}
