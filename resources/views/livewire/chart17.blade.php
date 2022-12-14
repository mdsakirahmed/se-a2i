<div class="h-100">
    <style>
        #chart_id_{{ $chart->id }} {
            height: 800px;
            width: 800px;
            max-width: 800px;
            margin: 0 auto;
        }
        @media screen and (max-width: 480px) {
                #chart_id_{{ $chart->id }} {
                height: auto;
                width: auto;
                max-width: auto;
                margin: 0 auto;
            }
        }
    </style>
    <div class="card h-100">
        <div class="card-header">
            <h5>{{ $name }}</h5>
            <div>
                @can('chart info edit')<button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>@endcan
            </div>
        </div>
       <div class="card-body">
        <div class="card-desc">
            <p>
            {!! $description !!}
            </p>
        </div>
            <select wire:model="selected_division" wire:change="change_division">
                <option value="">All division</option>
                @foreach ($divisions as $division)
                <option value="{{ $division }}">{{ $division }}</option>
                @endforeach
            </select>
            <select wire:model="selected_district" wire:change="update_chart">
                <option value="">All district</option>
                @foreach ($districts as $district)
                    <option value="{{ $district }}">{{ $district }}</option>
                @endforeach
            </select>
            <select wire:model="selected_year" wire:change="update_chart">
                <option value="">All Year</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>           
            <figure class="highcharts-figure">
                <div id="chart_id_{{ $chart->id }}"> </div>
            </figure>
       </div>
        <div class="card-footer">
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
            //First loaded data
            Highcharts.mapChart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
            
            //chart update and re-render
            window.addEventListener("chart_update_{{ $chart->id }}", event => {
                Highcharts.mapChart("chart_id_{{ $chart->id }}", event.detail.data);
            });
        </script>
    @endpush
    
</div>
