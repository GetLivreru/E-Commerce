<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function findByCode($code)
    {
        return Product::where('code', $code)->first();
    }

    public function save(Product $product)
    {
        $product->save();
        return $product;
    }
}
