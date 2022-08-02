<div>
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

    </style>
   <div class="card">
    <div class="card-header">
        {{ $name }}
    </div>
   <div class="card-body">
    <button type="butto" class="btn  @if($selected_division == 'All') btn-success @else btn-secondary @endif btn-sm m-2" wire:click="filterDivision('All')">All</button>
    @foreach ($divisions as $division)
        <button type="butto" class="btn @if($selected_division == $division) btn-success @else btn-secondary @endif btn-sm m-2" wire:click="filterDivision('{{ $division }}')">{{ $division }}</button>
    @endforeach
    <figure class="highcharts-figure">
        <div id="chart_id_{{ $chart->id }}"></div>
        <p class="text-center">
            <button type="butto" class="btn btn-secondary btn-sm m-2" wire:click="$emit('editChartInfo', '{{ $chart->id }}')">Edit</button>
        </p>
    </figure>
   </div>
    <div class="card-footer">
        {!! $description !!}
    </div>
   </div>
    <script>
    </script>

<script>
    $(document).ready(function () {
        //First loaded data
        Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});

        //Data update by filter
        window.addEventListener('division_filter_event', event => {
            Highcharts.chart("chart_id_{{ $chart->id }}", event.detail.data);
        });
    });
</script>



</div>
