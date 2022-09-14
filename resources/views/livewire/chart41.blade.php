<div class="h-100">
   <div class="card h-100">
       <div class="card-header">
           <h5>{{ $name }}</h5>
           <div>
                @can('chart info edit') <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button> @endcan
           </div>
       </div>
       <div class="card-body">
        <div class="card-desc">
            <p class="mb-2">
            {!! $description !!}
            </p>
        </div>
            <div>
                <select wire:model="f_year" wire:change="chart_update">
                    <option value="">All Fiscal Year</option>
                    @foreach($f_years as $f_year)
                        <option value="{{ $f_year }}">{{ $f_year }}</option>
                    @endforeach
                </select>
         
                <select wire:model="imp_min" wire:change="chart_update">
                    <option value="">All Implementing Ministry 1</option>
                    @foreach($imp_mins as $imp_min)
                        <option value="{{ $imp_min }}">{{ $imp_min }}</option>
                    @endforeach 
                </select>
                <select wire:model="imp_min" wire:change="chart_update">
                    <option value="">All Implementing Ministry 2</option>
                    @foreach($imp_2_mins as $imp_2_min)
                        <option value="{{ $imp_min }}">{{ $imp_2_min }}</option>
                    @endforeach 
                </select>
            </div>
            
           <figure class="highcharts-figure" wire:ignore>
               <div id="chart_id_{{ $chart->id }}"> </div>
           </figure>
           <br>
           <div id="x_slider_for_{{ $chart->id }}" wire:ignore></div>
           <div id="y_slider_for_{{ $chart->id }}" wire:ignore></div>
           <br>




           {{-- <button type="butto"
               class="btn  @if($chart_type == 'column') btn-success @else btn-secondary @endif btn-sm m-2"
               wire:click="change_chart_type('column')">Column</button>
           <button type="butto" class="btn  @if($chart_type == 'bar') btn-success @else btn-secondary @endif btn-sm m-2"
               wire:click="change_chart_type('bar')">Bar</button>
           <button type="butto"
               class="btn  @if($chart_type == 'line') btn-success @else btn-secondary @endif btn-sm m-2"
               wire:click="change_chart_type('line')">Line</button>
           <button type="butto"
               class="btn  @if($chart_type == 'area') btn-success @else btn-secondary @endif btn-sm m-2"
               wire:click="change_chart_type('area')">Area</button> --}}
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


    <script>
         $(document).ready(function () {
            //First loaded data
            Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});

            //chart update and re-render
            window.addEventListener("chart_update_{{ $chart->id }}", event => {
                Highcharts.chart("chart_id_{{ $chart->id }}", event.detail.data);
            });

            $("#x_slider_for_{{ $chart->id }}").slider({
                min: {{ $x_min_default_value }},
                max: {{ $x_max_default_value }},
                step: 1,
                values: [{{ $x_min_default_value }}, {{ $x_max_default_value }}],
                slide: function(event, ui) {
                    @this.set('x_min', ui.values[0]);
                    @this.set('x_max', ui.values[1]);
                    @this.chart_update()
                }
            });
           
            $("#y_slider_for_{{ $chart->id }}").slider({
                min: {{ $y_min_default_value }},
                max: {{ $y_max_default_value }},
                step: 1,
                values: [{{ $y_min_default_value }}, {{ $y_max_default_value }}],
                slide: function(event, ui) {
                    @this.set('y_min', ui.values[0]);
                    @this.set('y_max', ui.values[1]);
                    @this.chart_update()
                }
            });
           
        });
    </script>
</div>
