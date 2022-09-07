<div class="h-100">
    <div class="card h-100">
        <div class="card-header">
            <h5>{{ $name }}</h5>
            <div>
                @can('chart info edit')<button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button> @endcan
            </div>
        </div>
        <div class="card-body">
            <div class="card-desc">
                <p>
                {!! $description !!}
                </p>
            </div>
            <select wire:model="selected_broad_sector" wire:change="chart_update">
                <option value="All">All</option>
                @foreach ($broad_sectors as $broad_sector)
                    <option value="{{ $broad_sector }}">{{ $broad_sector }}</option>
                @endforeach
            </select>
            <select wire:model="chart_type" wire:change="chart_update">
                <option value="column">Column</option>
                <option value="bar">Bar</option>
                <option value="pie">Pie</option>
                <option value="area">Area</option>
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
    <script>
        $(document).ready(function() {
            //First loaded data
            Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
            
            //chart update and re-render
            window.addEventListener("chart_update_{{ $chart->id }}", event => {
                Highcharts.chart("chart_id_{{ $chart->id }}", event.detail.data);
            });
        });
    </script>
</div>
