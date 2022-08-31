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
    <div class="slidecontainer">
        <input type='range' class="slider" min='0' max='{{ count(collect($fotmated_data_set)->pluck('name')) - 1 }}' step='1' value='0' id="range_chart_id_{{ $chart->id }}" /> 
        <div class="range-label-container">
            @foreach (collect($fotmated_data_set)->pluck('name') as $key => $year)
            <div class="range-label">{{ str_replace("-20", "-", $year) }}</div>
            @endforeach
        </div>
        <button type="button" class="btn btn-sm btn-success" id="start_btn_chart_id_{{ $chart->id }}">start</button>
        <button type="button" class="btn btn-sm btn-warning" id="stop_btn_chart_id_{{ $chart->id }}">stop</button>
    </div>
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


            //Run the update function when the slider is changed
            d3.select("#range_chart_id_{{ $chart->id }}").on('input', function() {
                window.livewire.emit('change_selected_key_and_chart_update_43', this.value);
            });

            let myTimer;
            d3.select("#start_btn_chart_id_{{ $chart->id }}").on("click", function() {
            clearInterval (myTimer);
                myTimer = setInterval (function() {
                let b= d3.select("#range_chart_id_{{ $chart->id }}");
                let t = (+b.property("value") + 1) % (+b.property("max") + 1);
                if (t == 0) { t = +b.property("min"); }
                b.property("value", t);
                window.livewire.emit('change_selected_key_and_chart_update_43', t);
                console.log(t);
                }, 3000);
            });

            d3.select("#stop_btn_chart_id_{{ $chart->id }}").on("click", function() {
                clearInterval (myTimer);
            });
        });
    </script>
</div>