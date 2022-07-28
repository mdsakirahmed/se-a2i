<?php

namespace App\Http\Livewire\Widgets;

use Livewire\Component;

class EditChart extends Component
{

    public function render()
    {
        return view('widgets.edit-chart');
    }

    public function eventCall($number){
        $this->dispatchBrowserEvent('event_name', ['number' => $number]);
    }
}
