<div class="h-100">
   <div class="card h-100">
    <div class="card-header">
        <h5>{{ $name }}</h5>
        <div>
                @can('chart info edit')<button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>@endcan
            </div>
    </div>
   <div class="card-body">
    <div class="card-header-desc">
        <p>
        {!! $description !!}
        </p>
    </div>
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
            Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
        </script>
   @endpush
    
</div>
