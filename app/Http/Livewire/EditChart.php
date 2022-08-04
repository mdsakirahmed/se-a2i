<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Livewire\Component;

class EditChart extends Component
{
    public $mes ='No one';
    public Chart $chart;

    public $message;

    public function render()
    {
        return view('livewire.edit-chart');
    }

    protected $listeners = ['editChartInfo'];
 
    public function editChartInfo($chart_id)
    {
        $this->chart = Chart::find($chart_id);
        $this->dispatchBrowserEvent('open_modal');
    }
}
