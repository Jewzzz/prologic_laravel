<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class UserDeatails extends Component
{
    public $users;

    public function render()
    {
        $this->users = User::all();
        return view('livewire.user-deatails');
    }
}
