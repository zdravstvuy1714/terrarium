<?php

namespace App\Repositories\User;

use App\Models\User\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    public function getUsers(): LengthAwarePaginator
    {
        return User::query()->paginate();
    }

    public function getUserById(string $id): User|Model
    {
        return User::query()->findOrFail($id);
    }

    public function getUserByEmail(string $email): User|Model
    {
        return User::query()
            ->where('email', '=', $email)
            ->firstOrFail();
    }
}
