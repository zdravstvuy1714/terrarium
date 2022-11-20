<?php

namespace App\DataTransferObjects\Authentication\Authentication;

use App\Models\Token\AuthenticationToken;
use Spatie\LaravelData\Data;

class UserSuccessfullyAuthenticatedData extends Data
{
    public function __construct(
        public readonly AuthenticationToken $access_token,
    ) {
    }
}
