<?php

namespace App\Actions\Authentication\Authentication;

use App\DataTransferObjects\Authentication\Authentication\AuthenticateUserData;
use App\DataTransferObjects\Authentication\Authentication\UserSuccessfullyAuthenticatedData;
use App\Exceptions\Exceptions\HashValuesCheckFailed;
use App\Interfaces\Authentication\AuthenticationTokenService;
use App\Repositories\User\UserRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthenticateUserAction
{
    private Hasher $hasher;

    private AuthenticationTokenService $tokenService;

    private UserRepository $userRepository;

    public function __construct(
        Hasher $hasher,
        AuthenticationTokenService $tokenService,
        UserRepository $userRepository
    ) {
        $this->hasher = $hasher;
        $this->tokenService = $tokenService;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws AuthenticationException
     */
    public function execute(AuthenticateUserData $data): UserSuccessfullyAuthenticatedData
    {
        try {
            $user = $this->userRepository->getUserByEmail($data->email);

            if (! $this->hasher->check($data->password, $user->getPassword())) {
                throw new HashValuesCheckFailed();
            }
        } catch (ModelNotFoundException|HashValuesCheckFailed) {
            throw new AuthenticationException(
                message: trans('auth.failed'),
            );
        }

        $access_token = $this->tokenService->create($user);

        return new UserSuccessfullyAuthenticatedData(
            access_token: $access_token,
        );
    }
}
