<?php

namespace App\Transformers\Authentication;

use App\DataTransferObjects\Authentication\Registration\UserSuccessfullyRegisteredData;
use League\Fractal\TransformerAbstract;

class UserSuccessfullyRegisteredTransformer extends TransformerAbstract
{
    public function transform(UserSuccessfullyRegisteredData $data): array
    {
        return [
            'access_token' => $data->access_token->getValue(),
            'token_type' => $data->access_token->getType(),
            'expires_in' => $data->access_token->getTTL(),
        ];
    }
}
