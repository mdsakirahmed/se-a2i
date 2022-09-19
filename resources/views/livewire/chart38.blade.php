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
             <div class="row">              
                 <div class="form-group col-md-2">
                     <label for="" class="col-form-label">Fiscal Year</label>
                     <select class="form-control" wire:model="fiscal_year" wire:change="chart_update">
                         <option value="">All</option>
                         @foreach($fiscal_yeas as $fiscal_year)
                             <option value="{{ $fiscal_year }}">{{ $fiscal_year }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div class="form-group col-md-2">
                     <label for="" class="col-form-label">Programme Type</label>
                     <select class="form-control"wire:model="program_type" wire:change="chart_update">
                         <option value="">All</option>
                         @foreach($program_types as $program_type)
                             <option value="{{ $program_type }}">{{ $program_type }}</option>
                         @endforeach 
                     </select>
                 </div>
             </div>
 
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
                let chart38 = Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});
                chart38.series[0].points.forEach(function(point) {
                    if(point.shapeArgs && point.dataLabel) {
                        if(point.shapeArgs.width < point.dataLabel.width) {
                            point.dataLabel.hide();
                        }
                    }
                });
    
                //chart update and re-render
                window.addEventListener("chart_update_{{ $chart->id }}", event => {
                    let chart38 = Highcharts.chart("chart_id_{{ $chart->id }}", event.detail.data);
                    chart38.series[0].points.forEach(function(point) {
                        if(point.shapeArgs && point.dataLabel) {
                            if(point.shapeArgs.width < point.dataLabel.width) {
                                point.dataLabel.hide();
                            }
                        }
                    });
                });
            });

            Highcharts.setOptions({
                lang: {
                    thousandsSep: ','
                }
            });
            
        </script>
    @endpush
     
 </div>
 