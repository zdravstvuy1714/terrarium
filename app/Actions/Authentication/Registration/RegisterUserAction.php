<?php

namespace App\Actions\Authentication\Registration;

use App\DataTransferObjects\Authentication\Registration\RegisterUserData;
use App\DataTransferObjects\Authentication\Registration\UserSuccessfullyRegisteredData;
use App\Interfaces\Authentication\AuthenticationTokenService;
use App\Models\User\User;
use App\Models\User\UserProfile;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\DB;

class RegisterUserAction
{
    private Hasher $hasher;

    private AuthenticationTokenService $tokenService;

    public function __construct(Hasher $hasher, AuthenticationTokenService $tokenService)
    {
        $this->hasher = $hasher;
        $this->tokenService = $tokenService;
    }

    public function execute(RegisterUserData $data): UserSuccessfullyRegisteredData
    {
        $user = DB::transaction(function () use ($data) {
            $user = new User();
            $user->setEmail($data->email);
            $user->setPassword($this->hasher->make($data->password));
            $user->save();

            $profile = new UserProfile();
            $profile->setUserID($user->id);
            $profile->setFirstName($data->first_name);
            $profile->setLastName($data->last_name);
            $profile->setBirthDate($data->birth_date);
            $profile->setSex($data->sex);
            $profile->save();

            return $user;
        });

        $access_token = $this->tokenService->create($user);

        return new UserSuccessfullyRegisteredData(
            access_token: $access_token,
        );
    }
}
