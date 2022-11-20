<?php

namespace App\DataTransferObjects\Authentication\Authentication;

use Spatie\LaravelData\Data;

class AuthenticateUserData extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public static function rules(): array
    {
        return [
            'email' => ['required'],
            'password' => ['required'],
        ];
    }
}
