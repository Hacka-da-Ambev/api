<?php

namespace Source\User\Repositories;

use App\Models\User as UserModel;
use Source\User\Domain\{ User, UserDTO };
use Source\User\Ports\Out\IUserRepository;

class UserEloquentRepository implements IUserRepository
{

    public function create(UserDTO $data): User
    {
        $user = new UserModel();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->password);
        $user->save();

        return new User(
            $user->id,
            $user->name,
            $user->email
        );
    }

    public function getByEmail(string $email): ?User
    {
        $user = UserModel
            ::query()
            ->where('email', $email)
            ->first();

        if (!$user) {
            return null;
        }

        return new User(
            $user->id,
            $user->name,
            $user->email
        );
    }
}
