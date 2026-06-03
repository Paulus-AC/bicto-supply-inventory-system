<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\PasskeyAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

#[Fillable(['name', 'employee_id', 'email', 'password', 'role'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

    public const ADMIN_ROLE = 1;
    public const MEMBER_ROLE = 2;
    public const ROLE_TYPES = [
        self::ADMIN_ROLE => 'Admin',
        self::MEMBER_ROLE => 'Member',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the transactions for the user.
     *
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the role name of the user.
     * @return string 
     */
    public function roleName(): string
    {
        return self::ROLE_TYPES[$this->role] ?? '';
    }

    /**
     * Scope a query to search users by name, email, or employee ID.
     *
     * @param  Builder  $query
     * @param  string  $term
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $term)
    {
        $term = "%$term%";

        return $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('employee_id', 'like', $term);
        });
    }

    /**
     * Determine if the user has an admin role.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ADMIN_ROLE;
    }

    /**
     * Determine if the user has a member role.
     *
     * @return bool
     */
    public function isMember(): bool
    {
        return $this->role === self::MEMBER_ROLE;
    }
}
