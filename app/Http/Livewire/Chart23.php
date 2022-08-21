<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart23 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 23;

    public function render()
    {
        $this->chart =Chart::findOrFail($this->chart_id);
        if(app()->currentLocale() == 'bn'){
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
        }else{
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
        }

        return view('livewire.chart23');
    }
}