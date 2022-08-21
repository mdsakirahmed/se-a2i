<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart21 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 21;
    public $countries, $selected_country, $years, $selected_year;

    public function render()
    {
        $this->chart = Chart::findOrFail($this->chart_id);
        if (app()->currentLocale() == 'bn') {
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
        } else {
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
        }

        return view('livewire.chart21', [
            'chart_data_set' => $this->get_data(),
        ]);
    }

    public function change_divition()
    {
        $this->selected_district = null;
        $this->update_chart();
    }
    public function update_chart()
    {
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }

    public function get_data()
    {

        $db_data = DB::connection('mysql2')->select("SELECT fiscal_year, country, remittance_in_crore_bdt FROM corona_socio_info.economy_remittance_countrywise");

        $this->years = collect($db_data)->pluck('fiscal_year')->unique();

        $formated_data = [];
        foreach (collect($db_data)->groupBy('country') as $country => $country_wise_data) {
            if ($this->selected_year) {
                $value = collect($country_wise_data)->where('year', $this->selected_year)->sum('remittance_in_crore_bdt');
            } else {
                $value = collect($country_wise_data)->sum('remittance_in_crore_bdt');
            }
            // ** DB district are Upercase but out json file is not same as a string, that is why whe change DISTRICT to District format value by ucfirst(strtolower(trans($district)))
            array_push($formated_data, [
                'country' => ucfirst(strtolower(trans($country))), 'z' => round($value)
            ]);
        }

        //Get data from json file
        $geojson = json_decode(file_get_contents(public_path('assets/json/world.topo.json')), true);

        //Make map data set
        return [

            'chart' => [
                'borderWidth' => 1,
                'map' => collect($geojson)
            ],

            'title' => [
                'text' => ""
            ],
            
            'legend' => [
                'enabled' => false
            ],

            'mapNavigation' => [
                'enabled' => true,
                'buttonOptions' => [
                    'verticalAlign' => 'bottom'
                ]
            ],
            'colorAxis' => [
                'minColor' => '#f6c6d0',
                'maxColor' => '#A31A37',
                'min' => collect($formated_data)->min('z'),
                'max' => collect($formated_data)->max('z')
            ],
            'series' => [[
                'colorKey' => 'clusterPointsAmount',
                'name' => 'Countries',
                'enableMouseTracking' => false
            ], [
                'type' => 'mapbubble',
                'name' => '',
                'joinBy' => ['name', 'country'],
                'data' => collect($formated_data)->map(function ($data) {
                    return $data;
                }),
    
                'tooltip' => [
                    'pointFormat' => 'Country: {point.properties.name} <br> Emittance In Crore Bdt: {point.z}'
                ]
            ]]
        ];
    }
}
