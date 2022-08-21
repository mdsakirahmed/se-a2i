<div>
   <div class="card">
    <div class="card-header">
        {{ $name }}
        <div>
                <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>
            </div>
    </div>
   <div class="card-body">
    <figure class="highcharts-figure">
        <div id="chart_id_{{ $chart->id }}"> </div>
    </figure>
   </div>
    <div class="card-footer">
        {!! $description !!}
    </div>
   </div>
    <script>
        Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
    </script>
</div>