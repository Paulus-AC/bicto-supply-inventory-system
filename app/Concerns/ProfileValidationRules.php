<?php

namespace App\Concerns;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait ProfileValidationRules
{
    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function profileRules(?int $userId = null): array
    {
        return [
            'name' => $this->nameRules(),
            'employee_id' => $this->employeeIdRules(),
            'email' => $this->emailRules($userId),
            'role' => $this->roleRules(),
        ];
    }

    /**
     * Get the validation rules used to validate user names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function nameRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rules used to validate user employee IDs.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function employeeIdRules(): array
    {
        return ['required', 'string', 'max:255', Rule::unique(User::class)];
    }

    /**
     * Get the validation rules used to validate user emails.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function emailRules(?int $userId = null): array
    {
        return [
            'required',
            'string',
            'email',
            'max:255',
            $userId === null
                ? Rule::unique(User::class)
                : Rule::unique(User::class)->ignore($userId),
        ];
    }

    /**
     * Get the validation rules used to validate user roles.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function roleRules(): array
    {
        return ['required', Rule::in(array_keys(User::ROLE_TYPES))];
    }
}
