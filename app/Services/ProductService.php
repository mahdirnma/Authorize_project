<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getProducts()
    {
        return app(TryService::class)(function (){
            return Product::where('is_active',1)->get();
        });
    }
    public function addProduct($product)
    {
        return app(TryService::class)(function () use ($product){
            return Product::create($product);
        });
    }
    public function getProduct($product)
    {
        return app(TryService::class)(function () use ($product){
            return $product;
        });
    }
    public function updateProduct($request,Product $product){
        return app(TryService::class)(function () use ($request,$product){
            $product->update($request);
            return $product;
        });
    }

}
