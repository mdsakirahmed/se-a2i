<div class="h-100">
    <style>
        #chart_id_{{ $chart->id }} {
            height: 800px;
            min-width: 800px;
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
    <div class="card h-100">
        <div class="card-header">
            <h5>{{ $name }}</h5>
            <div>
                @can('chart info edit')<button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>@endcan
            </div>
        </div>
       <div class="card-body">
        <div class="card-desc">
            <p>
            {!! $description !!}
            </p>
        </div>
        <select wire:model="selected_division" wire:change="change_divition">
            <option value="">All Division</option>
            <option value="Khulna">Khulna</option>
            <option value="Barisal">Barisal</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Chittagong">Chittagong</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Rangpur">Rangpur</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Mymensingh">Mymensingh</option>
        </select>
        <select wire:model="selected_district" wire:change="update_chart">
            <option value="">All District</option>
            @foreach ($districts as $district)
                <option value="{{ $district }}">{{ $district }}</option>
            @endforeach
        </select>
        
        <figure class="highcharts-figure">
            <div id="chart_id_{{ $chart->id }}"> </div>
        </figure>
       </div>
        {{-- <div class="card-footer">
            {!! $description !!}
        </div> --}}
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
