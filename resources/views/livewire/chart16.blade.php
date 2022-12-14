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
            <button type="butto"
                class="btn  @if($selected_division == 'All') btn-success @else btn-secondary @endif btn-sm m-2"
                wire:click="filterDivision('All')">All</button>
            @foreach ($divisions as $division)
            <button type="butto"
                class="btn @if($selected_division == $division) btn-success @else btn-secondary @endif btn-sm m-2"
                wire:click="filterDivision('{{ $division }}')">{{ $division }}</button>
            @endforeach
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
            $(document).ready(function() {
                //First loaded data
                Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
                
                //chart update and re-render
                window.addEventListener("chart_update_{{ $chart->id }}", event => {
                    Highcharts.chart("chart_id_{{ $chart->id }}", event.detail.data);
                });
            });
        </script>
    @endpush
    

</div>