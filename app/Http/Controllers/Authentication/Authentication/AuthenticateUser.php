<?php

namespace App\Http\Controllers\Authentication\Authentication;

use App\Actions\Authentication\Authentication\AuthenticateUserAction;
use App\DataTransferObjects\Authentication\Authentication\AuthenticateUserData;
use App\Transformers\Authentication\UserSuccessfullyAuthenticatedTransformer;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;

class AuthenticateUser
{
    /**
     * @throws AuthenticationException
     */
    public function __invoke(AuthenticateUserData $data, AuthenticateUserAction $action): JsonResponse
    {
        $authenticationData = $action->execute($data);

        return fractal($authenticationData, new UserSuccessfullyAuthenticatedTransformer())->respond();
    }
}
