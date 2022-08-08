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
               
                <div class="form-group col-md-4">
                    <label for="" class="col-form-label">Fiscal Year</label>
                    <select class="form-control" wire:model="f_year" wire:change="chart_update">
                        <option value="">Fiscal Year</option>
                        @foreach($f_years as $f_year)
                            <option value="{{ $f_year }}">{{ $f_year }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-md-4">
                    <label for="" class="col-form-label">Implementing Ministry 1</label>
                    <select class="form-control"wire:model="imp_min" wire:change="chart_update">
                        <option value="">Implementing Ministry 1</option>
                        @foreach($imp_mins as $imp_min)
                            <option value="{{ $imp_min }}">{{ $imp_min }}</option>
                        @endforeach 
                    </select>
                </div>
            
                <div class=" form-group col-md-4">
                    <label for="" class="col-form-label">Implementing Ministry 2</label>
                    <select class="form-control"wire:model="imp_min" wire:change="chart_update">
                        <option value="">Implementing Ministry 2</option>
                        @foreach($imp_2_mins as $imp_2_min)
                            <option value="{{ $imp_min }}">{{ $imp_2_min }}</option>
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
