<div class="h-100">
    <div class="card h-100">
        <div class="card-header">
            <h5>{{ $name }}</h5>
            <div>
                @can('chart info edit')<button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>@endcan
            </div>
        </div>
        <div class="card-body">
            <select wire:model="selected_column" wire:change="chart_update">
                    <option value="poverty">Poverty gap</option>
                    <option value="squared_poverty">Squared poverty</option>
            </select>
            <select wire:model="selected_column_type" wire:change="chart_update">
                    <option value="lower">Lower poverty line</option>
                    <option value="upper">Upper poverty line</option>
            </select>

            <figure class="highcharts-figure">
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
