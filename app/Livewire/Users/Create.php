<?php

namespace App\Livewire\Users;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\UserForm;
use App\Models\User;

class Create extends BaseComponent
{
    public UserForm $form;

    public function render()
    {
        return view('livewire.users.create');
    }

    public function createUser()
    {
        $this->validate();

        User::create([
            'name' => $this->form->name,
            'employee_id' => $this->form->employee_id,
            'email' => $this->form->email,
            'role' => $this->form->role,
            'password' => $this->form->password,
        ]);

        $this->form->reset();

        return redirect()->route('users.listing');
    }
}
