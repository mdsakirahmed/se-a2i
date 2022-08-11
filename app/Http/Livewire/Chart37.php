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
        $this->chart =Chart::findOrFail($this->chart_id);
        if(app()->currentLocale() == 'bn'){
            $this->name = $this->chart->bn_name;
            $this->description = $this->chart->bn_description;
        }else{
            $this->name = $this->chart->en_name;
            $this->description = $this->chart->en_description;
        }

        return view('livewire.chart37', [
            'chart_data_set' => $this->get_data(),
        ]);
    }

    public function get_data()
    {
        $data = json_decode(file_get_contents(public_path('assets/json/bangladesh.geojson.json')), true); 

        // $data = collect($data['features']);
        // $data = ;


        $data = [
          'crs' => `{type: 'name', properties: {name: 'urn:ogc:def:crs:EPSG::31493'}}`,
          'features'=> collect($data['features']),
          'type'=> "FeatureCollection"
      ];

        return [
            'chart' => [
                'map' => collect($data)
              ],
          
              'title' => [
                'text' => "GeoJSON in Highmaps"
              ],
          
              'accessibility' => [
                'typeDescription' => "Map of Germany."
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
                  'data' => [
                        ['DE.SH', 728],
                      ['DE.BE', 710],
                      ['DE.MV', 963],
                      ['DE.HB', 541],
                      ['DE.HH', 622],
                      ['DE.RP', 866],
                      ['DE.SL', 398],
                      ['DE.BY', 785],
                      ['DE.SN', 223],
                      ['DE.ST', 605],
                      ['DE.NW', 237],
                      ['DE.BW', 157],
                      ['DE.HE', 134],
                      ['DE.NI', 136],
                      ['DE.TH', 704],
                  ],
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
                    'format' => "{point.properties.NAME_1}"
                  ]
                ]
              ]
        ];
    }
}
