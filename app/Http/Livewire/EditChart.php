<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Livewire\Component;

class EditChart extends Component
{
    public $mes = 'No one';
    public Chart $chart;
    public $en_name, $bn_name, $en_description, $bn_description, $bn_datasource, $en_datasource;

    public function render()
    {
        return view('livewire.edit-chart');
    }

    public function update()
    {
        if (auth()->user()->can('chart info edit')) {
            $this->chart->update([
                'en_name' => $this->en_name,
                'bn_name' => $this->bn_name,
                'en_description' => $this->en_description,
                'bn_description' => $this->bn_description,
                'bn_datasource' => $this->bn_datasource,
                'en_datasource' => $this->en_datasource,
            ]);
            toastr()->success(__('Updated'));
            $this->dispatchBrowserEvent('refresh-page');
        } else {
            toastr()->error(__('You have not permission'));
        }
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
        $this->render();
    }
}
