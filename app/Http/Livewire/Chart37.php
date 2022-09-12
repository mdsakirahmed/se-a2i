<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart37 extends Component
{
  public  Chart $chart;
  public $name, $description, $datasource, $chart_id = 37;
  public $selected_district = [],  $selected_division = [];

  public function render()
  {
    $this->chart = Chart::findOrFail($this->chart_id);
    if (app()->currentLocale() == 'bn') {
      $this->name = $this->chart->bn_name;
      $this->description = $this->chart->bn_description;
      $this->datasource = $this->chart->bn_datasource;
    } else {
      $this->name = $this->chart->en_name;
      $this->description = $this->chart->en_description;
      $this->datasource = $this->chart->en_datasource;
    }

    return view('livewire.chart37', [
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
    $array_data_set = [
      ['division' => 'Khulna', 'district' => 'Bagerhat', 'value' => 45.16],
      ['division' => 'Chattogram', 'district' => 'Bandarban', 'value' => 25.00],
      ['division' => 'Barishal', 'district' => 'Barguna', 'value' => 34.48],
      ['division' => 'Barishal', 'district' => 'Barishal', 'value' => 29.82],
      ['division' => 'Barishal', 'district' => 'Bhola', 'value' => 46.15],
      ['division' => 'Rajshahi', 'district' => 'Bogura', 'value' => 10.00],
      ['division' => 'Chattogram', 'district' => 'Brahmanbaria', 'value' => 36.67],
      ['division' => 'Chattogram', 'district' => 'Chandpur', 'value' => 62.75],
      ['division' => 'Chattogram', 'district' => 'Chattogram', 'value' => 24.64],
      ['division' => 'Khulna', 'district' => 'Chuadanga', 'value' => 38.10],
      ['division' => 'Chattogram', 'district' => 'Cumilla', 'value' => 30.88],
      ['division' => 'Chattogram', 'district' => "Cox's Bazar", 'value' => 51.35],
      ['division' => 'Dhaka', 'district' => 'Dhaka', 'value' => 43.33],
      ['division' => 'Rangpur', 'district' => 'Dinajpur', 'value' => 40.00],
      ['division' => 'Dhaka', 'district' => 'Faridpur', 'value' => 55.77],
      ['division' => 'Chattogram', 'district' => 'Feni', 'value' => 53.33],
      ['division' => 'Rangpur', 'district' => 'Gaibandhah', 'value' => 55.17],
      ['division' => 'Dhaka', 'district' => 'Gazipur', 'value' => 33.33],
      ['division' => 'Dhaka', 'district' => 'Gopalganj', 'value' => 31.03],
      ['division' => 'Sylhet', 'district' => 'Habiganj', 'value' => 57.50],
      ['division' => 'Mymensingh', 'district' => 'Jamalpur', 'value' => 40.00],
      ['division' => 'Khulna', 'district' => 'Jashore', 'value' => 30.95],
      ['division' => 'Barishal', 'district' => 'Jhalokati', 'value' => 30.00],
      ['division' => 'Khulna', 'district' => 'Jhenaidah', 'value' => 43.33],
      ['division' => 'Rajshahi', 'district' => 'Joypurhat', 'value' => 50.00],
      ['division' => 'Chattogram', 'district' => 'Khagrachari', 'value' => 40.00],
      ['division' => 'Khulna', 'district' => 'Khulna', 'value' => 33.33],
      ['division' => 'Dhaka', 'district' => 'Kishoreganj', 'value' => 56.41],
      ['division' => 'Rangpur', 'district' => 'Kurigram', 'value' => 73.33],
      ['division' => 'Khulna', 'district' => 'Kushtia', 'value' => 46.67],
      ['division' => 'Chattogram', 'district' => 'Lakshmipur', 'value' => 56.67],
      ['division' => 'Rangpur', 'district' => 'Lalmonirhat', 'value' => 70.00],
      ['division' => 'Dhaka', 'district' => 'Madaripur', 'value' => 53.33],
      ['division' => 'Khulna', 'district' => 'Magura', 'value' => 47.62],
      ['division' => 'Dhaka', 'district' => 'Manikganj', 'value' => 40.00],
      ['division' => 'Sylhet', 'district' => 'Moulvi Bazar', 'value' => 65.52],
      ['division' => 'Khulna', 'district' => 'Meherpur', 'value' => 50.00],
      ['division' => 'Dhaka', 'district' => 'Munshiganj', 'value' => 23.68],
      ['division' => 'Mymensingh', 'district' => 'Mymensingh', 'value' => 42.34],
      ['division' => 'Rajshahi', 'district' => 'Naogaon', 'value' => 17.50],
      ['division' => 'Khulna', 'district' => 'Narail', 'value' => 45.00],
      ['division' => 'Dhaka', 'district' => 'Narayanganj', 'value' => 44.44],
      ['division' => 'Dhaka', 'district' => 'Narsingdi', 'value' => 45.16],
      ['division' => 'Rajshahi', 'district' => 'Natore', 'value' => 5.88],
      ['division' => 'Rajshahi', 'district' => 'Chapai Nawabganj', 'value' => 50.00],
      ['division' => 'Mymensingh', 'district' => 'Netrokona', 'value' => 64.00],
      ['division' => 'Rangpur', 'district' => 'Nilphamari', 'value' => 53.33],
      ['division' => 'Chattogram', 'district' => 'Noakhali', 'value' => 51.72],
      ['division' => 'Rajshahi', 'district' => 'Pabna', 'value' => 50.00],
      ['division' => 'Rangpur', 'district' => 'Panchagarh', 'value' => 70.00],
      ['division' => 'Barishal', 'district' => 'Patuakhali', 'value' => 60.00],
      ['division' => 'Barishal', 'district' => 'Pirojpur', 'value' => 53.33],
      ['division' => 'Dhaka', 'district' => 'Rajbari', 'value' => 57.89],
      ['division' => 'Rajshahi', 'district' => 'Rajshahi', 'value' => 65.00],
      ['division' => 'Chattogram', 'district' => 'Rangamati', 'value' => 70.00],
      ['division' => 'Rangpur', 'district' => 'Rangpur', 'value' => 67.50],
      ['division' => 'Khulna', 'district' => 'Satkhira', 'value' => 34.48],
      ['division' => 'Dhaka', 'district' => 'Shariatpur', 'value' => 52.17],
      ['division' => 'Mymensingh', 'district' => 'Sherpur', 'value' => 69.39],
      ['division' => 'Rajshahi', 'district' => 'Sirajganj', 'value' => 67.57],
      ['division' => 'Sylhet', 'district' => 'Sunamganj', 'value' => 52.17],
      ['division' => 'Sylhet', 'district' => 'Sylhet', 'value' => 52.58],
      ['division' => 'Dhaka', 'district' => 'Tangail', 'value' => 29.79],
      ['division' => 'Rangpur', 'district' => 'Thakurgaon', 'value' => 50.00],
    ];

    //Get data from json file
    $geojson = json_decode(file_get_contents(public_path('assets/json/mangladesh-districts.geojson.json')), true);

    $formated_data = [];
    foreach (collect($array_data_set)->groupBy('district') as $district => $district_wise_data) {
      array_push($formated_data, [
        'district' => $district,
        'value' => round(collect($district_wise_data)->sum('value'), 2),
        'division' => collect($district_wise_data)->first()['division']
      ]);
    }

    $this->divisions = collect($formated_data)->pluck('division')->unique();

    if ($this->selected_division) {
      $this->districts = collect($formated_data)->where('division', $this->selected_division)->pluck('district');
    } else {
      $this->districts = collect($formated_data)->pluck('district');
    }

    //Get data from json file
    $geojson = json_decode(file_get_contents(public_path('assets/json/mangladesh-districts.geojson.json')), true);

    //Filter data
    $filter_geojson = $geojson;
    $filter_geojson['features'] = [];
    foreach ($geojson['features'] as $feature) {
      if ($this->selected_district && $this->selected_division) {
        if ($feature['properties']['district'] == $this->selected_district && $feature['properties']['division'] == $this->selected_division) {
          array_push($filter_geojson['features'], $feature);
        }
      } else if ($this->selected_district && !$this->selected_division) {
        if ($feature['properties']['district'] == $this->selected_district) {
          array_push($filter_geojson['features'], $feature);
        }
      } else if (!$this->selected_district && $this->selected_division) {
        if ($feature['properties']['division'] == $this->selected_division) {
          array_push($filter_geojson['features'], $feature);
        }
      } else {
        array_push($filter_geojson['features'], $feature);
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

      'credits' => [
        'enabled' => false
      ],

      'accessibility' => [
        'typeDescription' => ""
      ],
      'legend' => [
        'enabled' => false
      ],
      'mapNavigation' => [
        'enabled' => true,
        'buttonOptions' => [
          'verticalAlign' => "bottom"
        ]
      ],

      'colorAxis' => [
        'tickPixelInterval' => 100,
        'min' => collect($formated_data)->min('value'),
        'max' => collect($formated_data)->max('value'),
        'type' => 'logarithmic',
        'stops' => [
          [0, '#80ce0c'],
          [0.5, '#00b4d8'],
          [1, '#dc235b']
        ]
      ],
      'tooltip' => [
        'useHTML' => true,
        'headerFormat' => '',
        'pointFormat' => 'District: {point.district}<br> Moderate to Severe Food Insecurity : {point.value:,.2f}',
        'style' => [
          'color' => '#fff'
        ],
        'valueDecimals' => 0,
        'backgroundColor' => '#444444',
        'borderColor' => '#eeee',
        'borderRadius' => 10,
        'borderWidth' => 3,
      ],
      'series' => [
        [
          'data' => collect($formated_data)->map(function ($data) {
            return [$data['district'], $data['value']];
          }),
          'keys' => ["district", "value"],
          'joinBy' => "district",
          'states' => [
            'hover' => [
              'color' => "#a800ff"
            ]
          ],
          'dataLabels' => [
            'enabled' => true,
            'format' => "{point.properties.district}",
            'style' => [
              'textShadow' => false,
              'strokeWidth' => 0,
              'textOutline' => false,
              'color' => '#323232'
            ]
          ]
        ]
      ]
    ];
  }
}
