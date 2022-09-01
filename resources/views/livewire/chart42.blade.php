<div>
    <div class="card">
     <div class="card-header">
         <div>{{ $name }}</div>
         <div> @can('chart info edit')<button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>@endcan </div>
     </div>
    <div class="card-body">
     <figure class="highcharts-figure">
         <div id="chart_id_{{ $chart->id }}"> </div>
     </figure>
     @livewire('component.renge-component', ['min' => null, 'max' => null, 'step' => null, 'value' => null, 'chart_id' => $chart->id, 'data_array' => collect($fotmated_data_set)->pluck('name')])
    </div>
     <div class="card-footer">
         {!! $description !!}
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