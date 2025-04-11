<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\ApiResponseBuilder;
use App\Services\CategoryService;
use App\Services\UserService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(public CategoryService $service)
    {
    }

    public function index()
    {
        $result=$this->service->getCategories();
        return (new ApiResponseBuilder())->data(CategoryResource::collection($result->data))->response();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $result=$this->service->addCategory($request->validated());
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->data(new CategoryResource($result->data))->message('category added successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('category added unsuccessfully');
        return $apiResponse->response();
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $result=$this->service->getCategory($category);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->data(new CategoryResource($result->data))->message('category showed successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('category show unsuccessfully');
        return $apiResponse->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $result=$this->service->updateCategory($request->validated(),$category);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->data(new CategoryResource($result->data))->message('category updated successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('category updated unsuccessfully');
        return $apiResponse->response();
    }
    public function destroy(Category $category)
    {
        //
    }
}
