<?php

namespace App\Http\Controllers\Authentication\Registration;

use App\Actions\Authentication\Registration\RegisterUserAction;
use App\DataTransferObjects\Authentication\Registration\RegisterUserData;
use App\Transformers\Authentication\UserSuccessfullyRegisteredTransformer;
use Illuminate\Http\JsonResponse;

class RegisterUser
{
    public function __invoke(RegisterUserData $data, RegisterUserAction $action): JsonResponse
    {
        $authenticationData = $action->execute($data);

        return fractal($authenticationData, new UserSuccessfullyRegisteredTransformer())->respond();
    }
}
