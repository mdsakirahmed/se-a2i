<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart37 extends Component
{
  public  Chart $chart;
  public $name, $description, $chart_id = 37;
  public $selected_districts = [],  $selected_divisions = [];

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

  public function update_chart()
  {
    $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
  }

  public function get_data()
  {

    $districts = [
      ['Bagerhat', 100],
      ['Bandarban', 100],
      ['Barguna', 100],
      ['Barisal', 100],
      ['Bhola', 100],
      ['Bogra', 100],
      ['Brahamanbaria', 100],
      ['Chandpur', 100],
      ['Chittagong', 100],
      ['Chuadanga', 100],
      ['Comilla', 100],
      ["Cox's Bazar", 100],
      ['Dhaka', 100],
      ['Dinajpur', 100],
      ['Faridpur', 100],
      ['Feni', 100],
      ['Gaibandha', 100],
      ['Gazipur', 100],
      ['Gopalganj', 100],
      ['Habiganj', 100],
      ['Jamalpur', 100],
      ['Jessore', 100],
      ['Jhalokati', 100],
      ['Jhenaidah', 100],
      ['Joypurhat', 100],
      ['Khagrachhari', 100],
      ['Khulna', 100],
      ['Kishoreganj', 100],
      ['Kurigram', 100],
      ['Kushtia', 100],
      ['Lakshmipur', 100],
      ['Lalmonirhat', 100],
      ['Madaripur', 100],
      ['Magura', 100],
      ['Manikganj', 100],
      ['Maulvibazar', 100],
      ['Meherpur', 100],
      ['Munshiganj', 100],
      ['Mymensingh', 100],
      ['Naogaon', 100],
      ['Narail', 100],
      ['Narayanganj', 100],
      ['Narsingdi', 100],
      ['Natore', 100],
      ['Nawabganj', 100],
      ['Netrakona', 100],
      ['Nilphamari', 100],
      ['Noakhali', 100],
      ['Pabna', 100],
      ['Panchagarh', 100],
      ['Patuakhali', 100],
      ['Pirojpur', 100],
      ['Rajbari', 100],
      ['Rajshahi', 100],
      ['Rangamati', 100],
      ['Rangpur', 100],
      ['Satkhira', 100],
      ['Shariatpur', 100],
      ['Sherpur', 100],
      ['Sirajganj', 100],
      ['Sunamganj', 100],
      ['Sylhet', 100],
      ['Tangail', 100],
      ['Thakurgaon', 100],
    ];

    //Get data from json file
    $geojson = json_decode(file_get_contents(public_path('assets/json/mangladesh-districts.geojson.json')), true);

    //Filter data
    $filter_geojson = $geojson;
    $filter_geojson['features'] = [];
    $filter_districts = [];
    foreach ($geojson['features'] as $feature) {
      if ($this->selected_districts && $this->selected_divisions) {
        if ($feature['properties']['district'] == $this->selected_districts && $feature['properties']['division'] == $this->selected_divisions) {
          array_push($filter_geojson['features'], $feature);
          array_push($filter_districts, $feature['properties']['district']);
        }
      } else if ($this->selected_districts && !$this->selected_divisions) {
        if ($feature['properties']['district'] == $this->selected_districts) {
          array_push($filter_geojson['features'], $feature);
        }
      } else if (!$this->selected_districts && $this->selected_divisions) {
        $this->districts = [];
        if ($feature['properties']['division'] == $this->selected_divisions) {
          array_push($filter_geojson['features'], $feature);
          array_push($filter_districts, $feature['properties']['district']);
        }
      } else {
        array_push($filter_geojson['features'], $feature);
        array_push($filter_districts, $feature['properties']['district']);
      }
    }
    $geojson = $filter_geojson;
    $this->districts = $filter_districts;


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
          'data' => $districts,
          'keys' => ["district", "value"],
          'joinBy' => "district",
          'name' => "Moderate to Severe Food Insecurity",
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
