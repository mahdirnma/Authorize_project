<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\ApiResponseBuilder;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(public UserService $service)
    {
    }
    public function index()
    {
        $result=$this->service->getUsers();
        return (new ApiResponseBuilder())->data(UserResource::collection($result->data))->response();
    }
    public function store(StoreUserRequest $request)
    {
        $result=$this->service->addUser($request->validated());
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->data(new UserResource($result->data))->message('user added successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('user added unsuccessfully');
        return $apiResponse->response();
    }
    public function show(User $user)
    {
        $result=$this->service->getUser($user);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->data(new UserResource($result->data))->message('user showed successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('user show unsuccessfully');
        return $apiResponse->response();
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        $result=$this->service->updateUser($request->validated(),$user);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->data(new UserResource($result->data))->message('user updated successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('user updated unsuccessfully');
        return $apiResponse->response();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $result=$this->service->deleteUser($user);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->message('user deleted successfully'):
            (new ApiResponseBuilder())->data($result->data)->message('user deleted unsuccessfully');
        return $apiResponse->response();
    }
}
