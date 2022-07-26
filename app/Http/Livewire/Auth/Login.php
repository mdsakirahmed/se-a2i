<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember;

    public function render()
    {
        return view('auth.login');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'nullable|boolean'
        ]);
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('backend.about');
        } else {
            toastr()->error('Incorrect credential please try again later.');
        }
    }
}
