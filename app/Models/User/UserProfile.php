<?php

namespace App\Models\User;

use App\Enums\SexEnum;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Rorecek\Ulid\HasUlid;

/**
 * Properties.
 * @property string $id
 * @property string $user_id
 * @property string $first_name
 * @property string $last_name
 * @property CarbonImmutable $birth_date
 * @property SexEnum $sex
 * @property CarbonImmutable $created_at
 * @property CarbonImmutable $updated_at
 *
 * Relationships.
 * @property User $user
 */
class UserProfile extends Model
{
    use HasUlid;
    use HasFactory;

    protected $table = 'user_profiles';

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'sex',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'sex' => SexEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getID(): string
    {
        return $this->id;
    }

    public function getUserID(): string
    {
        return $this->user_id;
    }

    public function setUserID(string $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getBirthDate(): CarbonImmutable
    {
        return $this->birth_date;
    }

    public function setBirthDate(string $birth_date): void
    {
        $this->birth_date = $birth_date;
    }

    public function getSex(): SexEnum
    {
        return $this->sex;
    }

    public function setSex(string $sex): void
    {
        $this->sex = $sex;
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
