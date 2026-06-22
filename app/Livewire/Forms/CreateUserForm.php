<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Form;

class CreateUserForm extends Form
{
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
                Rule::unique(User::class),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],

            'role' => [
                'required',
                Rule::in(array_keys(User::ROLE_TYPES)),
            ],

            'password' => [
                'required',
                Password::defaults(),
                'confirmed',
            ],
        ];
    }

    public function payload(): array
    {
        return [
            'name' => $this->name,
            'employee_id' => $this->employee_id,
            'email' => $this->email,
            'role' => $this->role,
            'password' => $this->password,
        ];
    }
}