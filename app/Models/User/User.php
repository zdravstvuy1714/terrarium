<?php

namespace App\Models\User;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Rorecek\Ulid\HasUlid;

/**
 * Properties.
 * @property string $id
 * @property string $email
 * @property string $password
 * @property CarbonImmutable $created_at
 * @property CarbonImmutable $updated_at
 *
 * Relationships.
 * @property UserProfile $profile
 */
class User extends AuthenticatableUser implements JWTSubject
{
    use HasUlid;
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function getID(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->getAuthPassword();
    }

    public function setPassword(string $password): string
    {
        return $this->password = $password;
    }

    public function getCreatedAt(): CarbonImmutable
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): CarbonImmutable
    {
        return $this->updated_at;
    }
}
