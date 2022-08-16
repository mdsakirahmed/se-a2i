<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Livewire\Component;

class EditChart extends Component
{
    public $mes ='No one';
    public Chart $chart;
    public $en_name, $bn_name, $en_description, $bn_description, $bn_datasource, $en_datasource;

    public function render()
    {
        return view('livewire.edit-chart');
    }

    protected $listeners = ['editChartInfo'];
 
    public function editChartInfo($chart_id)
    {
        $this->chart = Chart::find($chart_id);
        $this->en_name = $this->chart->en_name;
        $this->bn_name = $this->chart->bn_name;
        $this->en_description = $this->chart->en_description;
        $this->bn_description = $this->chart->bn_description;
        $this->bn_datasource = $this->chart->bn_datasource;
        $this->en_datasource = $this->chart->en_datasource;
        $this->dispatchBrowserEvent('open_modal');
    }
}
