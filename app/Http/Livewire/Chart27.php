<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart27 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 27;

    public function mount(){
        $this->year = '2020-21';
    }

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

        return view('livewire.chart27',[
            'collection' => $this->get_data()
        ]);
    }

    public function get_data(){
        // $this->db_collection = DB::connection('mysql2')->select("SELECT year, continent, country, commodity, sector, thousand_usd FROM corona_socio_info.economy_export_granular_commodity_country");

        // return collect( $this->db_collection)->where('year', '2020-21');
        $formated_data = [];
        // foreach(collect( $this->db_collection)->where('year', '2020-21') as $data){
        //     dd($data);
        // }

        // $geojson = json_decode(file_get_contents(public_path('assets/json/economy_export_granular_commodity_country.json')), true);

        // dd($geojson);

        // return collect($geojson)->where('year', $this->year);

        return true;

    }
   
}
