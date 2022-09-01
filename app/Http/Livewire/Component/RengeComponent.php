<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class RengeComponent extends Component
{
    public $width_percentage = null;
    public $min = null;
    public $max = null;
    public $step = null;
    public $value = null;
    public $chart_id = null;
    public $data_array = [];

    public function render()
    {
        return view('livewire.component.renge-component');
    }

    public function mount($min, $max, $step, $value, $chart_id, $data_array)
    {
        if(count($data_array) <= 0){
            $array_count = 1;
        }else{
            $array_count = count($data_array);
        }
        $this->min = $min ?? 0;
        $this->max = $max ?? ($array_count - 1);
        $this->step = $step ?? 1;
        $this->value = $value ?? 0;
        $this->chart_id = $chart_id;
        $this->data_array = $data_array;
        $this->width_percentage = 100 / $array_count;
    }
}
