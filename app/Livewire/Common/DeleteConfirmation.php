<?php

namespace App\Livewire\Common;

use Livewire\Attributes\On;
use App\Livewire\BaseComponent;

class DeleteConfirmation extends BaseComponent
{
    public int $id = 0;
    public string $dispatchAction = '';
    public string $modalName = 'delete-confirmation-modal';
    public string $heading = '';
    public string $subheading = '';

    public function render()
    {
        return view('livewire.common.delete-confirmation');
    }

    #[On('confirm-delete')]
    public function deleteUser(int $id, string $dispatchAction, string $modalName, string $heading, string $subheading)
    {

        $this->id = $id;
        $this->dispatchAction = $dispatchAction;
        $this->modalName = $modalName;
        $this->heading = $heading;
        $this->subheading = $subheading;
    }

    public function delete()
    {
        $this->dispatch($this->dispatchAction, id: $this->id);
    }
}
