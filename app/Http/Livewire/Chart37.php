<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart37 extends Component
{
  public  Chart $chart;
  public $name, $description, $chart_id = 37;

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

    return view('livewire.chart37', [
      'chart_data_set' => $this->get_data(),
    ]);
  }

  public function get_data()
  {
    $geojson = json_decode(file_get_contents(public_path('assets/json/bangladesh.geojson.json')), true);

    return [
      'chart' => [
        'map' => collect($geojson)
      ],

      'title' => [
        'text' => "GeoJSON in Highmaps"
      ],

      'accessibility' => [
        'typeDescription' => "Map of Bangladesh."
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
          'data' => [],
          'keys' => ["code_hasc", "value"],
          'joinBy' => "code_hasc",
          'name' => "Random data",
          'states' => [
            'hover' => [
              'color' => "#a4edba"
            ]
          ],
          'dataLabels' => [
            'enabled' => true,
            'format' => "{point.properties.district}"
          ]
        ]
      ]
    ];
  }
}
