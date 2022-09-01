<div>
   <div class="card">
        <div class="card-header">
            <h5>{{ $name }}</h5>
            <div>
                    @can('chart info edit')<button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>@endcan
                </div>
        </div>
        <div class="card-body">
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
        </div> 
   </div>
    <script>
        Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
    </script>
</div>
