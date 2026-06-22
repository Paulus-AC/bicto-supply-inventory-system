<?php

namespace App\Livewire\Users;

use App\Livewire\BaseComponent;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

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
        DB::beginTransaction();
        try {

            $user = User::findOrFail($id);

            $user->delete();

            $this->success(
                message: 'User deleted successfully.',
                modal: 'delete-confirmation-modal',
                event: 'user-deleted'
            );

            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
            $this->reportException($exception);

            $this->error(
                message: 'Failed to delete user.',
                modal: 'delete-confirmation-modal'
            );
        }
    }

    #[On('user-created')]
    #[On('user-updated')]
    #[On('user-deleted')]
    public function refreshUsers(): void
    {

    }

    private function fetchUserListings()
    {
        $userAuth = auth()->user();
        $users = User::search($this->search)->where('id', '!=', $userAuth->id)->orderBy('role', 'asc')->paginate(self::PER_PAGE);

        return $users;
    }
}
