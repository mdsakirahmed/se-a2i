<div>
   <div class="card">
       <div class="card-header">
           {{ $name }}
           <div><button type="button" class="btn btn-trans-icon"
                   wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>
           </div>
       </div>
       <div class="card-body">
           <div class="row">
               <!-- Division Dropdown -->
               <div class="form-group col-6">
                   <label for="division_early_marriage" class="col-form-label">Division</label>
                   <select id="division_early_marriage" wire:model="selected_division" class="form-control"
                       required="required" wire:change="change_chart_filter_by_division">
                       <option value="">All</option>
                       @foreach($divisions as $division)
                       <option value="{!! $division->division !!}">{!! $division->division !!}</option>
                       @endforeach
                   </select>
               </div>
               <!-- District Dropdown -->
               <div class="form-group col-6">
                   <label for="district_early_marriage" class="col-form-label">District</label>
                   <select id="district_early_marriage" wire:model="selected_district" class="form-control select2 " wire:change="change_chart_filter_by_district">
                       <option value="">All</option>
                       @foreach($districts as $district)
                       <option value="{!! $district->district ? `Cox'S Bazar` : `Cox\'s Bazar` !!}">{!! $district->district !!}</option>
                       @endforeach
                   </select>
               </div>
           </div>

           <figure class="highcharts-figure" wire:ignore>
               <div id="chart_id_{{ $chart->id }}"> </div>
           </figure>
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
