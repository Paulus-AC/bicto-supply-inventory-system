<?php

namespace App\Livewire\Users;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\CreateUserForm;
use App\Models\User;
use Flux\Flux;

class Create extends BaseComponent
{
    public CreateUserForm $form;

    public function createUser(): void
    {
        $this->form->validate();

        User::create(
            $this->form->payload()
        );

        $this->form->reset();

        $this->dispatch('user-created');

        Flux::toast(
            text: 'User successfully created',
            variant: 'success'
        );

        Flux::modal('create-user')->close();
    }

    public function render()
    {
        return view('livewire.users.create');
    }
}