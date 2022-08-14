<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart37 extends Component
{
  public  Chart $chart;
  public $name, $description, $chart_id = 37;
  public $selected_districts = [];

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
    $geojson = json_decode(file_get_contents(public_path('assets/json/mangladesh-districts.geojson.json')), true);

    // dd($geojson);

    // $td = collect($geojson)->with(['features' => function ($feature) {
    //   $feature->with(['properties' => function ($property) {
    //     $property->where('district', '==', "Dhaka");
    //   }]);
    // }])->get();

    //     $td = collect($geojson)->whereHas('features', function($feature){
    // dd($feature);
    //     });



    // $td = collect($geojson)->map(function ($feature) {
    //   dd($feature);
    // });

    // dd($td);

    $this->districts = [
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
          'data' => $this->districts,
          'keys' => ["district", "value"],
          'joinBy' => "district",
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
