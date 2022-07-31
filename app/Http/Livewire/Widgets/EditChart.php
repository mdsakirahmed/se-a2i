<?php

namespace App\Http\Livewire\Widgets;

use App\Models\Chart;
use Livewire\Component;

class EditChart extends Component
{
    public $mes ='No one';
    public Chart $chart;

    public function render()
    {
        return view('widgets.edit-chart');
    }

    protected $listeners = ['editChartInfo'];
 
    public function editChartInfo($chart_id)
    {
        $this->chart = Chart::find($chart_id);
        $this->dispatchBrowserEvent('open_modal');
    }
}
