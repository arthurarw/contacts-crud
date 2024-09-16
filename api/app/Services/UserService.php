<?php

namespace App\Services;

use App\DTOs\User\StoreUserDto;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class UserService
{
    public function __construct(private User $user)
    {
    }

    public function index(int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return $this->user->query()->paginate($perPage, ['*'], 'page', $page);
    }

    public function show(string $uuid)
    {
        try {
            $data = $this->user->query()->where('uuid', $uuid)->first();
            if (!$data) {
                throw new UserNotFoundException();
            }

            return $data;
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function store(StoreUserDto $data)
    {
        try {
            return $this->user->query()->create($data->toArray());
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function destroy(string $uuid): JsonResponse
    {
        try {
            $data = $this->user->query()->where('uuid', $uuid)->first();
            if (!$data) {
                throw new UserNotFoundException();
            }

            $data->delete();
            return response()->json(['message' => 'User deleted']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
