<?php

namespace App\Http\Livewire;

use App\Models\Chart;
use App\Models\SecondDatabase\RemittanceDistrictWise;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;



class Chart16 extends Component
{
    public  Chart $chart;
    public $name, $description, $chart_id = 16;
    public $selected_division = 'All';

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

        return view('livewire.chart16');
    }

    public $chart_data_set = [];
    public $divisions = [];

    public function mount()
    {
        $this->chart_data_set = $this->get_data();
        $data = DB::connection('mysql2')->select("SELECT  CONCAT(UCASE(SUBSTRING(`division`,1,1)),'', LCASE(SUBSTRING(`division`,2,LENGTH(`division`)))) as division
        FROM economy_remittance_districtwise GROUP BY division");
        foreach ($data as $division_data) {
            array_push($this->divisions, $division_data->division);
        }
    }


    public function get_data()
    {

        if ($this->selected_division == 'All') {
            // Query for all division
            $data = DB::connection('mysql2')->select("SELECT 
            CONCAT(UCASE(SUBSTRING(`division`,1,1)),'', LCASE(SUBSTRING(`division`,2,LENGTH(`division`)))) as division,
            SUM(IF(year IN ('2017-July' , '2017-August',
                    '2017-September',
                    '2017-November',
                    '2017-December',
                    '2017-June',
                    '2018-January',
                    '2018-February',
                    '2018-March',
                    '2018-April',
                    '2018-May',
                    '2018-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2017_18',
            SUM(IF(year IN ('2018-July' , '2018-August',
                    '2018-September',
                    '2018-November',
                    '2018-December',
                    '2018-June',
                    '2019-January',
                    '2019-February',
                    '2019-March',
                    '2019-April',
                    '2019-May',
                    '2019-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2018_19',
            SUM(IF(year IN ('2019-July' , '2019-August',
                    '2019-September',
                    '2019-November',
                    '2019-December',
                    '2019-June',
                    '2020-January',
                    '2020-February',
                    '2020-March',
                    '2020-April',
                    '2020-May',
                    '2020-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2019_20',
            SUM(IF(year IN ('2020-July' , '2020-August',
                    '2020-September',
                    '2020-November',
                    '2020-December',
                    '2020-June',
                    '2021-January',
                    '2021-February',
                    '2021-March',
                    '2021-April',
                    '2021-May',
                    '2021-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2020_21',
            SUM(IF(year IN ('2021-July' , '2021-August',
                    '2021-September',
                    '2021-November',
                    '2021-December',
                    '2021-June',
                    '2022-January',
                    '2022-February',
                    '2022-March',
                    '2022-April',
                    '2022-May',
                    '2022-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2021_22'
        FROM
            (SELECT 
                CONCAT(year, '-', month) AS year,
                    division,
                    remittance_in_million_usd
            FROM
                economy_remittance_districtwise
            GROUP BY year , month , district) AS a
        GROUP BY division ");
        } else {
            //Query for selected division
            $data = DB::connection('mysql2')->select("SELECT 
            a.district,
            SUM(IF(year IN ('2017-July' , '2017-August',
                    '2017-September',
                    '2017-November',
                    '2017-December',
                    '2017-June',
                    '2018-January',
                    '2018-February',
                    '2018-March',
                    '2018-April',
                    '2018-May',
                    '2018-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2017_18',
            SUM(IF(year IN ('2018-July' , '2018-August',
                    '2018-September',
                    '2018-November',
                    '2018-December',
                    '2018-June',
                    '2019-January',
                    '2019-February',
                    '2019-March',
                    '2019-April',
                    '2019-May',
                    '2019-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2018_19',
            SUM(IF(year IN ('2019-July' , '2019-August',
                    '2019-September',
                    '2019-November',
                    '2019-December',
                    '2019-June',
                    '2020-January',
                    '2020-February',
                    '2020-March',
                    '2020-April',
                    '2020-May',
                    '2020-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2019_20',
            SUM(IF(year IN ('2020-July' , '2020-August',
                    '2020-September',
                    '2020-November',
                    '2020-December',
                    '2020-June',
                    '2021-January',
                    '2021-February',
                    '2021-March',
                    '2021-April',
                    '2021-May',
                    '2021-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2020_21',
            SUM(IF(year IN ('2021-July' , '2021-August',
                    '2021-September',
                    '2021-November',
                    '2021-December',
                    '2021-June',
                    '2022-January',
                    '2022-February',
                    '2022-March',
                    '2022-April',
                    '2022-May',
                    '2022-June'),
                remittance_in_million_usd,
                0)) AS 'Fiscal_year_2021_22'
            FROM
                (SELECT 
                    CONCAT(year, '-', month) AS year,
                        district,
                        remittance_in_million_usd
                FROM
                    economy_remittance_districtwise
                WHERE
                    division = '$this->selected_division'
                GROUP BY year , month , district) AS a
            GROUP BY district ");
        }
        

        $district_wise_remittance_in_last_three_fiscal_year = collect($data)->map(function ($data) {
            return [
                "category" => $data->district ?? $data->division,
                "column-1" => round($data->Fiscal_year_2020_21, 2),
                "column-2" => round($data->Fiscal_year_2019_20, 2),
                "column-3" => round($data->Fiscal_year_2018_19, 2),
            ];
        })->toArray();

        $series = [];

        foreach($district_wise_remittance_in_last_three_fiscal_year as $data){
            array_push($series, [
                'name'=> $data['category'],
                'data'=> [$data['column-1'], $data['column-2'], $data['column-3']]
            ]);
        }

        return [
            'chart'=> [
                'type'=> 'bar'
            ],

            'credits' => [
                'enabled'=>false
            ],
            
            'title'=> [
                'text'=> ''
            ],
            'xAxis'=> [
                'categories'=> ["2020-21", "2019-20", "2018-19"],
                'labels'=>[
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
                ]
                
            ],
            'yAxis'=> [
                'min'=> 0,
                'title'=> [
                    'text'=> 'In Million US$',
                    'style'=>[
                        'fontSize'=>'15px'
                    ]
                ],
                'labels'=>[
                    'rotation'=>-45,
                    'format'=>'{value}',
                    'style'=>[
                        'fontSize'=>'13px'
                    ]
                ]
            ],
            'legend'=> [
                'reversed'=> true
            ],
            'legend' => [
                'align' =>'left',
                'verticalAlign'=> 'top',
                'layout'=> 'horizontal',
                'x'=> 0,
                'y'=> 0,
                'margin'=> 45
            ],
            'plotOptions'=> [
                'series'=> [
                    'stacking'=> 'normal',
                    'borderRadius'=>'10px',
                    'pointWidth'=>30
                ]
            ],
            'colors'=> ['#EE47B5','#FFB207','#7F3F98', '#83C341',],
            'series'=> $series,
        ];
    }

    public function filterDivision($division)
    {
        $this->selected_division = $division;
        $this->dispatchBrowserEvent("chart_update_$this->chart_id", ['data' => $this->get_data()]);
    }
}
