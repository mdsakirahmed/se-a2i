<div>
   <div class="card">
        <div class="card-header">
            {{ $name }}
            <div><button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button></div>
        </div>
        <div class="card-body">
            <figure class="highcharts-figure" wire:ignore>
                <div id="chart_id_{{ $chart->id }}"> </div>
            </figure>
            <button type="butto" class="btn  @if($chart_type == 'pie') btn-success @else btn-secondary @endif btn-sm m-2" wire:click="change_chart_type('pie')">Pie</button>
            <button type="butto" class="btn  @if($chart_type == 'bar') btn-success @else btn-secondary @endif btn-sm m-2" wire:click="change_chart_type('bar')">Bar</button>
            <button type="butto" class="btn  @if($chart_type == 'line') btn-success @else btn-secondary @endif btn-sm m-2" wire:click="change_chart_type('line')">Line</button>
            <button type="butto" class="btn  @if($chart_type == 'area') btn-success @else btn-secondary @endif btn-sm m-2" wire:click="change_chart_type('area')">Area</button>
        </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
   </div>
    <script>
         $(document).ready(function () {
            //First loaded data
            Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});

            //chart update and re-render
            window.addEventListener("chart_update_{{ $chart->id }}", event => {
                Highcharts.chart("chart_id_{{ $chart->id }}", event.detail.data);
            });
        });
    </script>
</div>
