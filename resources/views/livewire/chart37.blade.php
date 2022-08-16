<div>
    <style>
        #chart_id_{{ $chart->id }} {
            height: 800px;
            min-width: 800px;
            max-width: 800px;
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
        <select wire:model="selected_districts" wire:change="update_chart">
            <option value="">All district</option>
            @foreach ($districts as $district)
                <option value="{{ $district }}">{{ $district }}</option>
            @endforeach
        </select>

        <select wire:model="selected_divisions" wire:change="update_chart">
                <option value="">All division</option>
                <option value="Khulna">Khulna</option>
                <option value="Barisal">Barisal</option>
                <option value="Rajshahi">Rajshahi</option>
                <option value="Chittagong">Chittagong</option>
                <option value="Dhaka">Dhaka</option>
                <option value="Rangpur">Rangpur</option>
                <option value="Sylhet">Sylhet</option>
                <option value="Mymensingh">Mymensingh</option>
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
            //First loaded data
            Highcharts.mapChart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
            
            //chart update and re-render
            window.addEventListener("chart_update_{{ $chart->id }}", event => {
                Highcharts.mapChart("chart_id_{{ $chart->id }}", event.detail.data);
            });
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
