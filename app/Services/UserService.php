<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    public function findByEmail(string $email): User|null
    {
        return User::where('email', $email)->first();
    }

    public function findUserById(int $id): User|null
    {
        return User::find($id);
    }

    public function profileUpdate(array $data): void
    {
        $user = $this->findUserById(auth()->user()->getAuthIdentifier());
        $user->update($data);
    }
}
