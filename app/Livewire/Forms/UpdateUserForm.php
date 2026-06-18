<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Form;

class UpdateUserForm extends Form
{
    public int $user_id = 0;
    public string $name = '';
    public string $employee_id = '';
    public string $email = '';
    public string $role = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'employee_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class, 'employee_id')
                    ->ignore($this->user_id),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class, 'email')
                    ->ignore($this->user_id),
            ],

            'role' => [
                'required',
                Rule::in(array_keys(User::ROLE_TYPES)),
            ],

            'password' => [
                'nullable',
                Password::defaults(),
                'confirmed',
            ],
        ];
    }

    public function fillFromUser(User $user): void
    {
        $this->fill([
            'user_id' => $user->id,
            'name' => $user->name,
            'employee_id' => $user->employee_id,
            'email' => $user->email,
            'role' => $user->role,
        ]);
    }

    public function payload(): array
    {
        return [
            'name' => $this->name,
            'employee_id' => $this->employee_id,
            'email' => $this->email,
            'role' => $this->role,
        ];
    }
}