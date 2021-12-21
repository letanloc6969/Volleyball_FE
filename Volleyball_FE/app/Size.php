<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    public function product()
    {
        return $this
            ->belongsToMany(Product::class, 'product_sizes', 'product_id', 'size_id')
            ->withTimestamps();
    }
}
