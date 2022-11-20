<?php

namespace App\Transformers\User;

use App\Models\User\UserProfile;
use League\Fractal\TransformerAbstract;

class UserProfileTransformer extends TransformerAbstract
{
    public function transform(UserProfile $profile): array
    {
        return [
            'first_name' => $profile->first_name,
            'last_name' => $profile->last_name,
            'birth_date' => $profile->birth_date,
            'sex' => $profile->sex,
        ];
    }
}
