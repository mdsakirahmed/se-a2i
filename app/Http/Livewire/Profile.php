<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    public $old_password, $new_password;

    public function render()
    {
        return view('livewire.profile')->layout('layouts.backend.app');
    }

    public function submit()
    {
        $this->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:4'
        ]);
        if ($this->old_password) {
            if (Hash::check($this->old_password, auth()->user()->password)) {
                auth()->user()->update(['password' => bcrypt($this->new_password)]);
                toastr()->success('Successfully changed');
            } else {
                toastr()->error('Old password is not correct');
            }
        }
    }
}
