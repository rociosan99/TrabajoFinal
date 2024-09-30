<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;


class CreateRole extends Component
{
    public $name;

    public function save()
    {
        $role= Role::create([
            "name" => $this->name,
        ]);

        $this->reset(["name"]);

        $this->redirectRoute("users-roles-index");
    }

    public function render()
    {
        return view('livewire.roles.create-role');
    }
}
