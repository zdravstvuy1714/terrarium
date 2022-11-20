<?php

namespace App\Services\Authentication;

use App\Interfaces\Authentication\AuthenticationTokenService;
use App\Models\Token\AuthenticationToken;
use App\Models\User\User;
use Illuminate\Auth\AuthManager;

class JWTAuthenticationTokenService implements AuthenticationTokenService
{
    private AuthManager $authenticationManager;

    public function __construct(AuthManager $authenticationManager)
    {
        $this->authenticationManager = $authenticationManager;
    }

    public function create(User $user): AuthenticationToken
    {
        return new AuthenticationToken(
            value: $this->getToken($user),
            type: $this->getAccessTokenType(),
            ttl: $this->getAccessTokenTTL(),
        );
    }

    public function getToken(User $user): string
    {
        return $this->authenticationManager->login($user);
    }

    public function getAccessTokenType(): string
    {
        return 'Bearer';
    }

    public function getAccessTokenTTL(): int
    {
        return config('jwt.ttl') * 60;
    }
}
