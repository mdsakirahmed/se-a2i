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
      ['Bagerhat', 45.16],
      ['Bandarban', 25.00],
      ['Barguna', 34.48],
      ['Barisal', 29.82],
      ['Bhola', 46.15],
      ['Bogra', 10.00],
      ['Brahamanbaria', 36.67],
      ['Chandpur', 62.75],
      ['Chittagong', 24.64],
      ['Chuadanga', 38.10],
      ['Comilla', 30.88],
      ["Cox's Bazar", 51.35],
      ['Dhaka', 43.33],
      ['Dinajpur', 40.00],
      ['Faridpur', 55.77],
      ['Feni', 53.33],
      ['Gaibandha', 55.17],
      ['Gazipur', 33.33],
      ['Gopalganj', 31.03],
      ['Habiganj', 57.50],
      ['Jamalpur', 40.00],
      ['Jessore', 30.95],
      ['Jhalokati', 30.00],
      ['Jhenaidah', 43.33],
      ['Joypurhat', 50.00],
      ['Khagrachhari', 40.00],
      ['Khulna', 33.33],
      ['Kishoreganj', 56.41],
      ['Kurigram', 73.33],
      ['Kushtia', 46.67],
      ['Lakshmipur', 56.67],
      ['Lalmonirhat', 70.00],
      ['Madaripur', 53.33],
      ['Magura', 47.62],
      ['Manikganj', 40.00],
      ['Maulvibazar', 65.52],
      ['Meherpur', 50.00],
      ['Munshiganj', 23.68],
      ['Mymensingh', 42.34],
      ['Naogaon', 17.50],
      ['Narail', 45.00],
      ['Narayanganj', 44.44],
      ['Narsingdi', 45.16],
      ['Natore', 5.88],
      ['Nawabganj', 50.00],
      ['Netrakona', 64.00],
      ['Nilphamari', 53.33],
      ['Noakhali', 51.72],
      ['Pabna', 50.00],
      ['Panchagarh', 70.00],
      ['Patuakhali', 60.00],
      ['Pirojpur', 53.33],
      ['Rajbari', 57.89],
      ['Rajshahi', 65.00],
      ['Rangamati', 70.00],
      ['Rangpur', 67.50],
      ['Satkhira', 34.48],
      ['Shariatpur', 52.17],
      ['Sherpur', 69.39],
      ['Sirajganj', 67.57],
      ['Sunamganj', 52.17],
      ['Sylhet', 52.58],
      ['Tangail', 29.79],
      ['Thakurgaon', 50.00],
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
