<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public function store(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return $user->refresh();
    }

    public function update(User $user, array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        $user->update($data);

        return $user->refresh();
    }
}