<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class User extends Component
{
    public $name, $email, $password, $selected_user, $role;

    public function render()
    {
        return view('livewire.user', [
            'users' => ModelsUser::all(),
            'roles' => Role::all()
        ])->layout('layouts.backend.app');
    }

    public function createUser()
    {
        $this->name = $this->email = $this->password = $this->role = $this->selected_user = null;
    }

    public function submitUser()
    {
        if ($this->selected_user) {
            $data = $this->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $this->selected_user->id,
                'password' => 'nullable|string|min:4'
            ]);
            if(!$this->password){
                unset($data['password']);
            }else{
                $data['password'] = bcrypt($data['password']);
            }
            $this->selected_user->update($data);
            $user = $this->selected_user;
            toastr()->success(__('User Updated'));
        }else{
            $data = $this->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:4'
            ]);
            $data['password'] = bcrypt($data['password']);
            $user = ModelsUser::create($data);
            toastr()->success(__('User Created'));
        }
        $user->syncRoles($this->role);
        $this->createUser();
    }

    public function selectUser(ModelsUser $user){
        $this->selected_user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles()->first()->id ?? null;
    }

    public function deleteUser(ModelsUser $user){
        if($user->id == auth()->user()->id){
            toastr()->error(__('You can not delete your self'));
        }else{
            $user->delete();
            toastr()->success(__('Successfully Deleted'));
        }
    }
}
