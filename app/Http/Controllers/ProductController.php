<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Models\Product;
use App\Services\ApiResponseBuilder;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(public ProductService $service)
    {
    }
    public function index()
    {
        $result=$this->service->getProducts();
        return (new ApiResponseBuilder())->data(ProductResource::collection($result->data))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $result=$this->service->addProduct($request->validated());
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->data(new ProductResource($result->data))->message('product added successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('product added unsuccessfully');
        return $apiResponse->response();

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $result=$this->service->getProduct($product);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->data(new ProductResource($result->data))->message('product showed successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('product show unsuccessfully');
        return $apiResponse->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $result=$this->service->updateProduct($request->validated(),$product);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->data(new ProductResource($result->data))->message('product updated successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('product updated unsuccessfully');
        return $apiResponse->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $result=$this->service->deleteProduct($product);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->message('product deleted successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('product deleted unsuccessfully');
        return $apiResponse->response();

    }
}
