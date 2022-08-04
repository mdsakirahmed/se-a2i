<div>
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
