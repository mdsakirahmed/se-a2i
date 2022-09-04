<div class="h-100">
    <style type="text/css">
        .dropdown-trigger:hover {
            background-color: #0dcaf0;
        }

        .dropdown-content {
            display: none;
            position: absolute;
        }

        .dropdown-content ul {
            margin: 0;
            padding: 0;
            width: auto;
            margin-top: 10px;
        }

        .dropdown-content ul li {
            list-style: none;
            display: block;
            position: relative;
            transition: 0.2s;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 500;
            background-color: #ede7ef;
            color: #3a3a3a;
            z-index: 2;
        }

        .dropdown-content ul li ul {
            position: absolute;
            left: 100%;
            top: 0;
            visibility: hidden;
        }

        .dropdown-content ul li ul.active {
            visibility: visible;
        }

    </style>
    <div class="card h-100">
        <div class="card-header">
            <h5>{{ $name }}</h5>
            <div>
                @can('chart info edit') <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button> @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="card-desc">
                <p>
                {!! $description !!}
                </p>
            </div>
             <div class="row align-items-center">
                
                 <div class="form-group col-md-2">
                     <label for="" class="col-form-label">Fiscal Year</label>
                     <select class="form-control" wire:model="fiscal_year" wire:change="chart_update">
                         <option value="">All</option>
                         @foreach($fiscal_yeas as $fiscal_year)
                             <option value="{{ $fiscal_year }}">{{ $fiscal_year }}</option>
                         @endforeach
                     </select>
                 </div>
                 
                 <div class="form-group col-md-2">
                     <label for="" class="col-form-label">Programme Type</label>
                     <select class="form-control"wire:model="program_type" wire:change="chart_update">
                         <option value="">All</option>
                         @foreach($program_types as $program_type)
                             <option value="{{ $program_type }}">{{ $program_type }}</option>
                         @endforeach 
                     </select>
                 </div>
                 <div class="form-group col-md-8">
                     <div class="dropdown-container float-right">
                         <button class="dropdown-trigger btn btn-success btn-sm float-right">DropDown</button>
                         <div class="dropdown-content">
                             <ul>
                                 <li> 
                                    Implementing Ministry 1
                                     <ul>
                                        @foreach($implementing_ministry_1s as $implementing_ministry_1)
                                            <li><a href="javascript:void(0)" wire:click="filter_by_implementing_ministry_1('{{ $implementing_ministry_1 }}')">{{ $implementing_ministry_1 }}</a></li>
                                        @endforeach
                                     </ul>
                                 </li>
                                 <li> 
                                    Implementing Ministry  2
                                    <ul>
                                        @foreach($implementing_ministry_2s as $implementing_ministry_2)
                                            <li><a href="javascript:void(0)" wire:click="filter_by_implementing_ministry_2('{{ $implementing_ministry_2 }}')">{{ $implementing_ministry_2 }}</a></li>
                                        @endforeach
                                     </ul>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
 
            <figure class="highcharts-figure" wire:ignore>
                <div id="chart_id_{{ $chart->id }}"> </div>
            </figure>
        </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
    </div>
     <script>
          $(document).ready(function () {
             //First loaded data
             Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
 
             //chart update and re-render
             window.addEventListener("chart_update_{{ $chart->id }}", event => {
                 Highcharts.chart("chart_id_{{ $chart->id }}", event.detail.data);
             });
         });

         $(".dropdown-trigger").click(function() {
            $(this).siblings().toggle();
        });
        $(".dropdown-content > ul > li").click(function(e) {
            $(this).children().addClass("active");
            $(this).siblings().children().removeClass("active");
        });
     </script>
 </div>
 