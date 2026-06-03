<?php

namespace App\Livewire\Users;

use App\Livewire\BaseComponent;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Manage Users')]
class Listing extends BaseComponent
{
    public string $search = '';

    public function mount()
    {
        //
    }

    public function render()
    {
        $users = $this->fetchUserListings();

        return view('livewire.users.listing', [
            'users' => $users
        ]);
    }

    #[On('delete-user')]
    public function deleteUser(int $id)
    {
        $user = User::findOrFail($id);
        
        $user->delete();
    }

    private function fetchUserListings()
    {
        $userAuth = auth()->user();
        $users = User::search($this->search)->where('id', '!=', $userAuth->id)->orderBy('role', 'asc')->paginate(self::PER_PAGE);

        return $users;
    }
}