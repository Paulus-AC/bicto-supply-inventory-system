<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UpdateUserForm;
use App\Models\User;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
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

        $user->update(
            $this->form->payload()
        );

        if (filled($this->form->password)) {
            $user->update([
                'password' => $this->form->password,
            ]);
        }

        $this->form->reset();

        $this->dispatch('user-updated');

        Flux::toast(
            text: 'User successfully updated',
            variant: 'success'
        );

        Flux::modal('update-user')->close();
    }

    public function render()
    {
        return view('livewire.users.update');
    }
}
