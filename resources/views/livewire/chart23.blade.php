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
        <div id="slidecontainer">
            <input type='range' class="slider" min='0' max='{{ count(collect($fotmated_data_set)->pluck('name')) - 1 }}' step='1' value='0' id='rangeSlider' /> 
            <button type="button" class="btn btn-sm btn-success" id="start">start</button>
            <button type="button" class="btn btn-sm btn-warning" id="stop">stop</button>
        </div>
        </div>
         <div class="card-footer">
             {!! $description !!}
         </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.4.11/d3.min.js"></script>

        <script>
            $(document).ready(function() {
                //First loaded data
                Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
                
                //chart update and re-render
                window.addEventListener("chart_update_{{ $chart->id }}", event => {
                    Highcharts.chart("chart_id_{{ $chart->id }}", event.detail.data);
                });


                //Run the update function when the slider is changed
                d3.select('#rangeSlider').on('input', function() {
                    window.livewire.emit('change_selected_key_and_chart_update', this.value);
                });

                var myTimer;
                d3.select("#start").on("click", function() {
                clearInterval (myTimer);
                    myTimer = setInterval (function() {
                    var b= d3.select("#rangeSlider");
                    var t = (+b.property("value") + 1) % (+b.property("max") + 1);
                    if (t == 0) { t = +b.property("min"); }
                    b.property("value", t);
                    window.livewire.emit('change_selected_key_and_chart_update', t);
                    console.log(t);
                    }, 3000);
                });

                d3.select("#stop").on("click", function() {
                    clearInterval (myTimer);
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
                <button type="button" class="btn btn-secondary btn-sm m-2" wire:click="$emit('editChartInfo', '{{ $chart->id }}')">Edit</button>
            </p>
        </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
    </div>
</div>
