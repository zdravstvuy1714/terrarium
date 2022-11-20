<?php

namespace App\DataTransferObjects\Authentication\Registration;

use App\Models\Token\AuthenticationToken;

class UserSuccessfullyRegisteredData
{
    public function __construct(
        public readonly AuthenticationToken $access_token,
    ) {
    }
}
