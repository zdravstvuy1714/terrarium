<?php

namespace App\Transformers\User;

use App\Models\User\User;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [
        'profile'
    ];

    public function transform(User $user): array
    {
        return [
            'id' => $user->id,
            'email' => $user->email,
        ];
    }

    public function includeProfile(User $user): Item
    {
        return $this->item($user->profile, new UserProfileTransformer());
    }
}
