<?php

namespace Src\WorkHours\User\Infrastructure\Repositories;

use App\Models\User as UserEloquent;
use Src\WorkHours\User\Domain\Contracts\UserRepositoryContract;
use Src\WorkHours\User\Domain\User;
use Src\WorkHours\User\Domain\ValueObjects\UserEmail;
use Src\WorkHours\User\Domain\ValueObjects\UserId;

class EloquentUserRepositoryContract implements UserRepositoryContract
{

    public function findByCriteria(UserEmail $userEmail): ?User
    {
        return UserEloquent::query()->where('email', $userEmail->value())->first();
    }

    public function findById(UserId $id): ?User
    {
        $userEloquent = UserEloquent::query()->find($id->Value());
        if (is_null($userEloquent)) {
            return null;
        }
        $user = new User($userEloquent->email, $userEloquent->password, $userEloquent->token);
        $user->setId($userEloquent->id);

        return $user;
    }

    public function save(User $user): void
    {

        $userEloquent = UserEloquent::create([
            'email' => $user->email()->Value(),
            'password' => $user->Password()->Value(),
        ]);

        $userEloquent->save();

    }

    public function update(UserId $userId, User $user): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(UserId $id): bool
    {
        $user = UserEloquent::query()->find($id->Value());
        if (is_null($user)) {
            return false;
        }

        $user->delete();
        return true;
    }
}
