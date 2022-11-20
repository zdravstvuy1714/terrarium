<?php

namespace App\DataTransferObjects\Authentication\Registration;

use App\Enums\SexEnum;
use App\Models\User\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Spatie\LaravelData\Data;

class RegisterUserData extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $birth_date,
        public readonly string $sex,
    ) {
    }

    public static function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', Password::default()],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'sex' => ['required', new Enum(SexEnum::class)],
        ];
    }
}
