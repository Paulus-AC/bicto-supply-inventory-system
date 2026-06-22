<?php

namespace App\Livewire\Users;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\CreateUserForm;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class Create extends BaseComponent
{
    public CreateUserForm $form;

    public function createUser(): void
    {
        $this->form->validate();

        DB::beginTransaction();
        try {

            User::create(
                $this->form->payload()
            );

            $this->form->reset();

            $this->success(
                message: 'User created successfully.',
                modal: 'create-user',
                event: 'user-created'
            );
            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
            $this->reportException($exception);

            $this->error(
                message: 'Failed to create user.',
                modal: 'create-user'
            );
        }
    }
    
    public function render()
    {
        return view('livewire.users.create');
    }
}