<div class="h-100">
    <style type="text/css">
        .dropdown-trigger:hover {
            background-color: transparent;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 34px;
        }

        .dropdown-content ul {
            margin: 0;
            padding: 0;
            width: auto;
            margin-top: 10px;
            border-radius: 10px;
        }

        .dropdown-content ul li {
            list-style: none;
            display: block;
            position: relative;
            transition: 0.2s;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 500;
            background-color: #ffffff;
            border: 1px solid #f3f3f3;
            color: #3a3a3a;
            z-index: 2;
            box-shadow: 1px 2px 2px rgb(0 0 0 / 26%);
        }

        .dropdown-content ul li ul {
            position: absolute;
            right: 100%;
            top: 0;
            min-width: 220px;
            max-height: 300px;
            overflow-y: scroll;
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
                        <select class="form-control" wire:model="year" wire:change="chart_update">
                            <option value="">All</option>
                            @foreach($years as $fiscal_year)
                                <option value="{{ $fiscal_year }}">{{ $fiscal_year }}</option>
                            @endforeach
                        </select>
                    </div>
                 
                    <div class="form-group col-md-2">
                        <label for="" class="col-form-label">Programme Type</label>
                        <select class="form-control"wire:model="p_type" wire:change="chart_update">
                            <option value="">All</option>
                            @foreach($p_types as $program_type)
                                <option value="{{ $program_type }}">{{ $program_type }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="" class="col-form-label">Value Type</label>
                        <select class="form-control" wire:model="value_type" wire:change="chart_update">
                            <option value="budget">Budget</option>
                            <option value="coverage">Coverage</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="dropdown-container text-right">
                         <button class="dropdown-trigger btn-dropdown">Implementing Ministry</button>
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
            <div class="card-desc">
                <p>
                {!! $description !!}
                </p>
            </div>
            @if ($datasource && $datasource != "<p><br></p>")
                <div class="tooltip">
                    <i class="bx bx-info-circle"></i> 
                    Source
                    <span class="tooltiptext">
                        {!! $datasource !!}
                    </span>
                </div>
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                // First loaded data
                let chart40 = Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
                chart40.series[0].points.forEach(function(point) {
                    if(point.shapeArgs && point.dataLabel) {
                        if(point.shapeArgs.width < point.dataLabel.width) {
                            point.dataLabel.hide();
                        }
                    }
                });
    
                //chart update and re-render
                window.addEventListener("chart_update_{{ $chart->id }}", event => {
                    let chart40 = Highcharts.chart("chart_id_{{ $chart->id }}", event.detail.data);
                    chart40.series[0].points.forEach(function(point) {
                        if(point.shapeArgs && point.dataLabel) {
                            if(point.shapeArgs.width < point.dataLabel.width) {
                                point.dataLabel.hide();
                            }
                        }
                    });
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
    @endpush
     
 </div>
 