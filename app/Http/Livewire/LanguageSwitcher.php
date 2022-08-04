<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\App;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class LanguageSwitcher extends Component
{
    public function render()
    {
        return view('livewire.language-switcher');
    }

    public function change_language(){
        if(App::isLocale('en')){
            App::setLocale('bn');
            Session::put('locale', App::currentLocale());
        }else{
            App::setLocale('en');
            Session::put('locale', App::currentLocale());
        }
        toastr()->success(__('Language Changed'));
    }
}
