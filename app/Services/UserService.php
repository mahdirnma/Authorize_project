<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUsers()
    {
        return app(TryService::class)(function (){
            return User::where('is_active',1)->get();
        });
    }

    public function addUser($user)
    {
        return app(TryService::class)(function () use ($user){
            return User::create($user);
        });
    }

    public function getUser($user)
    {
        return app(TryService::class)(function () use ($user){
            return $user;
        });
    }
    public function updateUser($request,User $user){
        return app(TryService::class)(function () use ($request,$user){
            $user->update($request);
            return $user;
        });
    }
    public function deleteUser($user){
        return app(TryService::class)(function () use ($user){
            return $user->update(['is_active'=>0]);
        });
    }
}
