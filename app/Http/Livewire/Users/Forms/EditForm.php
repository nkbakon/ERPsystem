<?php

namespace App\Http\Livewire\Users\Forms;

use Livewire\Component;
use App\Models\User;

class EditForm extends Component
{
    public $user;

    public function rules()
    {
        return [
            'user.fname' => 'required',
            'user.lname' => 'required',
            'user.username' => 'required|unique:users,username,' . $this->user->id,
            'user.email' => 'required|unique:users,email,' . $this->user->id,
            'user.type' => 'required',
            'user.status' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate($this->rules());

        $editUser = $this->validate();

        $this->user->update($editUser);
        
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function render()
    {
        return view('users.components.edit-form');
    }
}

