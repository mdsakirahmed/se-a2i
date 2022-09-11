<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart19 extends Component
{
  public  Chart $chart;
  public $name, $description, $datasource, $chart_id = 19;
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

    return view('livewire.chart19', [
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
      ['division' => 'Khulna', 'district' => 'Bagerhat', 'value' => -68.69113349],
      ['division' => 'Chittagong', 'district' => 'Bandarban', 'value' => -60.75650118],
      ['division' => 'Barisal', 'district' => 'Barguna', 'value' => -73.44322344],
      ['division' => 'Barisal', 'district' => 'Barishal', 'value' => -69.36332544],
      ['division' => 'Barisal', 'district' => 'Bhola', 'value' => -64.10992617],
      ['division' => 'Rajshahi', 'district' => 'Bogura', 'value' => -69.80786825],
      ['division' => 'Chittagong', 'district' => 'Brahmanbaria', 'value' => -65.08020745],
      ['division' => 'Chittagong', 'district' => 'Chandpur', 'value' => -62.76629698],
      ['division' => 'Chittagong', 'district' => 'Chattogram', 'value' => -67.1510878],
      ['division' => 'Khulna', 'district' => 'Chuadanga', 'value' => -69.3490701],
      ['division' => 'Chittagong', 'district' => 'Cumilla', 'value' => -63.31046959],
      ['division' => 'Chittagong', 'district' => "Cox's Bazar", 'value' => -50.91558732],
      ['division' => 'Dhaka', 'district' => 'Dhaka', 'value' => -71.96178389],
      ['division' => 'Rangpur', 'district' => 'Dinajpur', 'value' => -75.06775068],
      ['division' => 'Dhaka', 'district' => 'Faridpur', 'value' => -64.04726315],
      ['division' => 'Chittagong', 'district' => 'Feni', 'value' => -63.24145386],
      ['division' => 'Rangpur', 'district' => 'Gaibandah', 'value' => -72.23602485],
      ['division' => 'Dhaka', 'district' => 'Gazipur', 'value' => -73.02234943],
      ['division' => 'Dhaka', 'district' => 'Gopalganj', 'value' => -63.38780641],
      ['division' => 'Sylhet', 'district' => 'Habiganj', 'value' => -70.31277302],
      ['division' => 'Mymensingh', 'district' => 'Jamalpur', 'value' => -70.17258222],
      ['division' => 'Khulna', 'district' => 'Jashore', 'value' => -68.87394378],
      ['division' => 'Barisal', 'district' => 'Jhalokati', 'value' => -69.01350798],
      ['division' => 'Khulna', 'district' => 'Jhenaidah', 'value' => -68.80663197],
      ['division' => 'Rajshahi', 'district' => 'Joypurhat', 'value' => -74.63948284],
      ['division' => 'Chittagong', 'district' => 'Khagrachari', 'value' => -66.25310174],
      ['division' => 'Khulna', 'district' => 'Khulna', 'value' => -76.08915907],
      ['division' => 'Dhaka', 'district' => 'Kishoreganj', 'value' => -69.56230161],
      ['division' => 'Rangpur', 'district' => 'Kurigram', 'value' => -68.7959299],
      ['division' => 'Khulna', 'district' => 'Kushtia', 'value' => -71.26133553],
      ['division' => 'Chittagong', 'district' => 'Lakshmipur', 'value' => -60.33665244],
      ['division' => 'Rangpur', 'district' => 'Lalmonirhat', 'value' => -72.33273056],
      ['division' => 'Dhaka', 'district' => 'Madaripur', 'value' => -58.09347392],
      ['division' => 'Khulna', 'district' => 'Magura', 'value' => -70.29388404],
      ['division' => 'Dhaka', 'district' => 'Manikganj', 'value' => -72.85665876],
      ['division' => 'Sylhet', 'district' => 'Moulvi Bazar', 'value' => -70.55438188],
      ['division' => 'Khulna', 'district' => 'Meherpur', 'value' => -68.08161351],
      ['division' => 'Dhaka', 'district' => 'Munshiganj', 'value' => -66.34211531],
      ['division' => 'Mymensingh', 'district' => 'Mymensingh', 'value' => -70.93044484],
      ['division' => 'Rajshahi', 'district' => 'Naogaon', 'value' => -67.35825434],
      ['division' => 'Khulna', 'district' => 'Narail', 'value' => -65.86620926],
      ['division' => 'Dhaka', 'district' => 'Narayanganj', 'value' => -71.02732794],
      ['division' => 'Dhaka', 'district' => 'Narsingdi', 'value' => -67.62850251],
      ['division' => 'Rajshahi', 'district' => 'Natore', 'value' => -71.51037938],
      ['division' => 'Rajshahi', 'district' => 'Chapai Nawabganj', 'value' => -66.26998224],
      ['division' => 'Mymensingh', 'district' => 'Netrokona', 'value' => -70.66140777],
      ['division' => 'Rangpur', 'district' => 'Nilphamari', 'value' => -74.70725995],
      ['division' => 'Chittagong', 'district' => 'Noakhali', 'value' => -62.41965008],
      ['division' => 'Rajshahi', 'district' => 'Pabna', 'value' => -70.63808574],
      ['division' => 'Rangpur', 'district' => 'Panchagarh', 'value' => -73.25102881],
      ['division' => 'Barisal', 'district' => 'Patuakhali', 'value' => -73.50103377],
      ['division' => 'Barisal', 'district' => 'Pirojpur', 'value' => -65.66319602],
      ['division' => 'Dhaka', 'district' => 'Rajbari', 'value' => -68.32323232],
      ['division' => 'Rajshahi', 'district' => 'Rajshahi', 'value' => -73.38340954],
      ['division' => 'Chittagong', 'district' => 'Rangamati', 'value' => -81.54761905],
      ['division' => 'Rangpur', 'district' => 'Rangpur', 'value' => -73.06168647],
      ['division' => 'Khulna', 'district' => 'Satkhira', 'value' => -72.0838276],
      ['division' => 'Dhaka', 'district' => 'Shariatpur', 'value' => -64.53880362],
      ['division' => 'Mymensingh', 'district' => 'Sherpur', 'value' => -69.59102902],
      ['division' => 'Rajshahi', 'district' => 'Sirajganj', 'value' => -71.85676393],
      ['division' => 'Sylhet', 'district' => 'Sunamganj', 'value' => -68.45661201],
      ['division' => 'Sylhet', 'district' => 'Sylhet', 'value' => -65.48116102],
      ['division' => 'Dhaka', 'district' => 'Tangail', 'value' => -74.07266111],
      ['division' => 'Rangpur', 'district' => 'Thakurgaon', 'value' => -75.14792899],
    ];

    //Get data from json file
    $geojson = json_decode(file_get_contents(public_path('assets/json/mangladesh-districts.geojson.json')), true);

    $formated_data = [];
    foreach (collect($array_data_set)->groupBy('district') as $district => $district_wise_data) {

      array_push($formated_data, [
        'district' => $district, 'value' => round(collect($district_wise_data)->sum('value'), 2), 'division' => collect($district_wise_data)->first()['division']
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

      'credits' => [
        'enabled' => false
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
        'tickPixelInterval' => 100,
        'min' => collect($formated_data)->min('value'),
        'max' => collect($formated_data)->max('value'),
        'minColor' => '#cfc5d4',
        'maxColor' => '#7F3F98'
      ],
      'tooltip' => [
        'useHTML' => true,
        'headerFormat' => '',
        'pointFormat' => 'District: {point.district}<br>Percent Change In Overseas Employment (19-20):	{point.value:,.2f}',
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
            return [$data['division'], $data['district'], $data['value']];
          }),
          'keys' => ["division", "district", "value"],
          'joinBy' => "district",
          'states' => [
            'hover' => [
              'color' => "#9cc13d"
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
