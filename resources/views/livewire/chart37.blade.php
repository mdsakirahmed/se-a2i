<div>
    <style>
        #chart_id_{{ $chart->id }} {
            height: 1500px;
            min-width: 1000px;
            max-width: 1000px;
            margin: 0 auto;
        }
    </style>
    <div class="card">
        <div class="card-header">
            {{ $name }}
            <div>
                <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>
            </div>
        </div>
       <div class="card-body">
        <select wire:model="selected_districts" multiple>
            @foreach ($districts as $district)
                <option value="{{ $district[0] }}">{{ $district[0] }}</option>
            @endforeach
        </select>
        <figure class="highcharts-figure">
            <div id="chart_id_{{ $chart->id }}"> </div>
        </figure>
       </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
       </div>
        <script>
            Highcharts.mapChart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
        </script>



    {{-- i frame --}}
    <div class="card">
        <div class="card-header">
            {{ $name }}
        </div>
        <div class="card-body container-iframe">
            <iframe class="esponsive-iframe" width="100%" height="660px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/FoodInsecurityIndex/Dashboard1?%3Aembed=y&%3AshowVizHome=no&:device=desktop">
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
