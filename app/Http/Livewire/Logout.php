<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function render()
    {
        return view('livewire.logout');
    }

    public function logout(){
        Auth::logout();
        toastr()->success('Successfully logout');
        return redirect()->route('login');
    }
}