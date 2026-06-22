<?php

namespace App\Livewire\Users;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\UpdateUserForm;
use App\Models\User;
use Exception;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class Update extends BaseComponent
{
    public UpdateUserForm $form;

    #[On('update-user')]
    public function open(int $userId): void
    {
        $user = User::findOrFail($userId);

        $this->form->fillFromUser($user);
    }

    public function updateUser(): void
    {
        $this->form->validate();

        $user = User::findOrFail($this->form->user_id);

        DB::beginTransaction();
        try {

            $user->update(
                $this->form->payload()
            );

            $this->form->reset();

            $this->success(
                message: 'User successfully updated.',
                modal: 'update-user',
                event: 'user-updated'
            );

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->reportException($exception);
            $this->error(
                message: 'Failed to update user.',
                modal: 'update-user'
            );
        }
    }

    public function render()
    {
        return view('livewire.users.update');
    }
}
