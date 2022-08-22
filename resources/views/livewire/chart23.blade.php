<div>
    <div>
        <div class="card">
         <div class="card-header">
             {{ $name }}
             <div> <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button> </div>
         </div>
        <div class="card-body">
         <figure class="highcharts-figure">
             <div id="chart_id_{{ $chart->id }}"> </div>
         </figure>
         @foreach ($fotmated_data_set as $key => $value)
            <button class="btn btn-danger" wire:click="change_selected_key_and_chart_update({{ $key }})">{{ $key }}</button>
         @endforeach
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
     

    <div class="card">
        <div class="card-header">
            {{ $name }}
        </div>
        <div class="card-body">
            <iframe width="100%" height="660px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/CountrywiseImportBarChart/Dashboard2?%3Aembed=y&%3AshowVizHome=no&:device=desktop">
            </iframe>
            <p class="text-center">
                <button type="butto" class="btn btn-secondary btn-sm m-2" wire:click="$emit('editChartInfo', '{{ $chart->id }}')">Edit</button>
            </p>
        </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
    </div>
</div>
