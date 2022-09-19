<div class="h-100">
   <div class="card h-100">
       <div class="card-header">
           <h5>{{ $name }}</h5>
           <div>
                @can('chart info edit')<button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button> @endcan
           </div>
       </div>
       <div class="card-body">
            <div>
                <select id="" wire:model="selected_division" wire:change="change_chart_filter_by_division">
                    <option value="">All Division</option>
                    @foreach($divisions as $division)
                    <option value="{!! $division->division !!}">{!! $division->division !!}</option>
                    @endforeach
                </select>   
                
                <select id="" wire:model="selected_district" wire:change="change_chart_filter_by_district">
                    <option value="">All District</option>
                    @foreach($districts as $district)
                    <option value="{!! str_replace("'", "\'", "$district->district") !!}">{!! $district->district !!}</option>
                    @endforeach
                </select>
            </div>
          
           <button type="butto"
               class="btn  @if($chart_type == 'column') btn-success @else btn-secondary @endif btn-sm m-2"
               wire:click="change_chart_type('column')">Column</button>
           <button type="butto" class="btn  @if($chart_type == 'bar') btn-success @else btn-secondary @endif btn-sm m-2"
               wire:click="change_chart_type('bar')">Bar</button>
           <button type="butto"
               class="btn  @if($chart_type == 'line') btn-success @else btn-secondary @endif btn-sm m-2"
               wire:click="change_chart_type('line')">Line</button>
           <button type="butto"
               class="btn  @if($chart_type == 'area') btn-success @else btn-secondary @endif btn-sm m-2"
               wire:click="change_chart_type('area')">Area</button>
            <figure class="highcharts-figure" wire:ignore>
               <div id="chart_id_{{ $chart->id }}"> </div>
           </figure>
            </div>
       <div class="card-footer">
        <div class="card-desc">
            <p>
            {!! $description !!}
            </p>
        </div>
        @if ($datasource && $datasource != "<p><br></p>")
            <div class="tooltip">
                <i class="bx bx-info-circle"></i> 
                Source
                <span class="tooltiptext">
                    {!! $datasource !!}
                </span>
            </div>
        @endif
    </div>
   </div>
   @push('scripts')
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
   @endpush
    
</div>
