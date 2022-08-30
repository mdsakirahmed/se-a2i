<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
    public $name, $email, $password, $selected_user;

    public function render()
    {
        return view('livewire.user', [
            'users' => ModelsUser::all()
        ])->layout('layouts.backend.app');
    }

    public function createUser()
    {
        $this->name = $this->email = $this->password = $this->selected_user = null;
    }

    public function submitUser()
    {
        if ($this->selected_user) {
            $data = $this->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $this->selected_user,
                'password' => 'nullable|string|min:4'
            ]);
            if(!$this->password){
                unset($data['password']);
            }
            $this->selected_user->update($data);
            toastr()->success(__('User Updated'));
        }else{
            $data = $this->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:4'
            ]);
            ModelsUser::create($data);
            toastr()->success(__('User Created'));
        }
        $this->createUser();
    }

    public function selectUser(ModelsUser $user){
        $this->selected_user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        // $this->password = $user->password;
    }
}
