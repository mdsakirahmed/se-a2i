<div>
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
            <select wire:model="selected_country" wire:change="update_chart">
                <option value="">All country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
            <select wire:model="selected_year" wire:change="update_chart">
                <option value="">All Year</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
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
            //First loaded data
            Highcharts.mapChart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
            
            //chart update and re-render
            window.addEventListener("chart_update_{{ $chart->id }}", event => {
                Highcharts.mapChart("chart_id_{{ $chart->id }}", event.detail.data);
            });
        </script>
    </div>

    

    <div class="card">
        <div class="card-header">
            {{ $name }}
        </div>
        <div class="card-body">
            <iframe width="100%" height="660px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/CountrywiseImport/Dashboard1?%3Aembed=y&%3AshowVizHome=no&:device=desktop">
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
