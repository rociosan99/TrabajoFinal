<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class EditUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function edit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $this->user->password,
        ]);

        session()->flash('message', 'User updated successfully.');
        return redirect()->route('users-users-index');
    }



    public function render()
    {
        return view('livewire.users.edit-user');
    }
}
