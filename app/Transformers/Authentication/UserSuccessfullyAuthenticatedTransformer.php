<?php

namespace App\Transformers\Authentication;

use App\DataTransferObjects\Authentication\Authentication\UserSuccessfullyAuthenticatedData;
use League\Fractal\TransformerAbstract;

class UserSuccessfullyAuthenticatedTransformer extends TransformerAbstract
{
    public function transform(UserSuccessfullyAuthenticatedData $data): array
    {
        return [
            'access_token' => $data->access_token->getValue(),
            'token_type' => $data->access_token->getType(),
            'expires_in' => $data->access_token->getTTL(),
        ];
    }
}
