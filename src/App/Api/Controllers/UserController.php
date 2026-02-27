<?php

namespace App\Api\Controllers;

use Domain\Users\Actions\CreateUserAction;
use Domain\Users\Actions\DestroyUserAction;
use Domain\Users\Actions\IndexUserAction;
use Domain\Users\Actions\ShowUserAction;
use Domain\Users\Actions\UpdateUserAction;
use Domain\Users\DataTransferObjects\UserIndexData;
use Domain\Users\DataTransferObjects\UserUpsertData;
use Domain\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Domain\Users\Exceptions\UserException;
use Illuminate\Support\Collection;

class UserController
{
    /**
     * @param IndexUserAction $action
     *
     * @return JsonResponse|Collection<int|string, UserIndexData>
     */
    public function index(IndexUserAction $action): Collection|JsonResponse
    {
        try {
            return $action->execute();
        } catch (UserException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getStatus());
        }
    }

    public function store(UserUpsertData $data, CreateUserAction $action): User|JsonResponse
    {
        try {
            return $action->execute($data);
        } catch (UserException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getStatus());
        }
    }

    public function show(User $user, ShowUserAction $action): User|JsonResponse
    {
        try {
            return $action->execute($user);
        } catch (UserException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getStatus());
        }
    }

    public function update(UserUpsertData $data, User $user, UpdateUserAction $action): User|JsonResponse
    {
        try {
            return $action->execute($user, $data);
        } catch (UserException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getStatus());
        }
    }

    public function destroy(User $user, DestroyUserAction $action): Response|JsonResponse
    {
        try {
            $action->execute($user);

            return response()->noContent();
        } catch (UserException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getStatus());
        }
    }
}
