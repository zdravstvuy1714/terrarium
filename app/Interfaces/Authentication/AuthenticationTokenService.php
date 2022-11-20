<?php

namespace App\Interfaces\Authentication;

use App\Models\Token\AuthenticationToken;
use App\Models\User\User;

interface AuthenticationTokenService
{
    public function create(User $user): AuthenticationToken;

    public function getToken(User $user): string;

    public function getAccessTokenType(): string;

    public function getAccessTokenTTL(): int;
}
