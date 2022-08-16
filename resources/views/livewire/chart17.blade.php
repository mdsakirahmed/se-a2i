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
            <select wire:model="selected_division" wire:change="change_division">
                <option value="">All division</option>
                @foreach ($divisions as $division)
                <option value="{{ $division }}">{{ $division }}</option>
                @endforeach
            </select>
            <select wire:model="selected_district" wire:change="update_chart">
                <option value="">All district</option>
                @foreach ($districts as $district)
                    <option value="{{ $district }}">{{ $district }}</option>
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
