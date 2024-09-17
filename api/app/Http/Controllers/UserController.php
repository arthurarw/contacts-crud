<?php

namespace App\Http\Controllers;

use App\DTOs\User\StoreUserDto;
use App\Helpers\PaginationHelper;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private UserService $service)
    {
    }

    public function index()
    {
        $data = $this->service->index(PaginationHelper::getPage(), PaginationHelper::getPerPage());
        return UserResource::collection($data);
    }

    public function show(string $uuid)
    {
        $data = $this->service->show($uuid);
        return new UserResource($data);
    }

    public function destroy(string $uuid)
    {
        return $this->service->destroy($uuid);
    }

    public function store(StoreUserRequest $request)
    {
        $request->validated();
        $data = $this->service->store(StoreUserDto::makeFromRequest($request));
        return new UserResource($data);
    }

    public function update(string $uuid, UpdateUserRequest $request)
    {
        $request->validated();
        $data = $this->service->update($uuid, StoreUserDto::makeFromRequest($request));
        return new UserResource($data);
    }
}
