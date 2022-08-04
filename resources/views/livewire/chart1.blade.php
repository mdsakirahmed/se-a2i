<div>
    <div class="card">
        <div class="card-header">
            {{ $name }}
        </div>
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="chart_id_{{ $chart_id }}"></div>
                <p class="text-center">
                    <button type="butto" class="btn btn-secondary btn-sm m-2" wire:click="$emit('editChartInfo', '{{ $chart_id }}')">Edit</button>
                </p>
            </figure>
        </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
    </div>
    
    <script>
        Highcharts.chart("chart_id_{{ $chart_id }}", {!! collect($chart_data_set) !!});
    </script>
</div>
