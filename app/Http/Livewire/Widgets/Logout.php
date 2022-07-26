<?php

namespace App\Http\Livewire\Widgets;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function render()
    {
        return view('widgets.logout');
    }

    public function logout(){
        Auth::logout();
        toastr()->success('Successfully logout');
        return redirect()->route('login');
    }
}
