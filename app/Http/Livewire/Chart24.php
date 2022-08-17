<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart24 extends Component
{
  public  Chart $chart;
  public $name, $description, $chart_id = 24;
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

    return view('livewire.chart24', [
      'chart_data_set' => $this->get_data(),
    ]);
  }

  public function change_divition(){
    $this->selected_district = null;
    $this->update_chart();
  }
  public function update_chart()
  {
    $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
  }

  public function get_data()
  {

    $db_data = DB::connection('mysql2')->select("SELECT fiscal_year, country, import_in_usd FROM corona_socio_info.economy_import_country");

    $this->countries = collect($db_data)->pluck('country')->unique();
    
    $this->years = collect($db_data)->pluck('fiscal_year')->unique();

    $formated_data = [];
    foreach (collect($db_data)->groupBy('country') as $country => $country_wise_data) {
        if ($this->selected_year) {
            $value = collect($country_wise_data)->where('year', $this->selected_year)->sum('import_in_usd');
        } else {
            $value = collect($country_wise_data)->sum('import_in_usd');
        }
        // ** DB district are Upercase but out json file is not same as a string, that is why whe change DISTRICT to District format value by ucfirst(strtolower(trans($district)))
        array_push($formated_data, [
            'country' => ucfirst(strtolower(trans($country))), 'value' => round($value)
        ]);
    }
    

    //Get data from json file
    $geojson = json_decode(file_get_contents(public_path('assets/json/world.topo.json')), true);
    // dd($geojson['arcs']);

    //Filter data
    $filter_geojson = $geojson;
    $filter_geojson['arcs'] = [];
    foreach ($geojson['arcs'] as $feature) {
        if ($this->selected_country) {
            if ($feature['properties']['name'] == $this->selected_country) {
                array_push($filter_geojson['arcs'], $feature);
            }
        } else {
            array_push($filter_geojson['arcs'], $feature);
        }
    }
    $geojson = $filter_geojson;


    //Make map data set
    return [
      'chart' => [
        'map' => collect($geojson)
      ],

      'title' => [
        'text' => ""
      ],

      'accessibility' => [
        'typeDescription' => ""
      ],

      'mapNavigation' => [
        'enabled' => true,
        'buttonOptions' => [
          'verticalAlign' => "bottom"
        ]
      ],

      'colorAxis' => [
        'tickPixelInterval' => 100
      ],

      'series' => [
        [
          'data' => collect($formated_data)->map(function($data){
            return [$data['country'], $data['value']];
        }),
          'keys' => ["country", "value"],
          'joinBy' => "country",
          'name' => "Moderate to Severe Food Insecurity",
          'states' => [
            'hover' => [
              'color' => "#a4edba"
            ]
          ],
          'dataLabels' => [
            'enabled' => true,
            'format' => "{point.name}"
          ]
        ]
      ]
    ];
  }
}
