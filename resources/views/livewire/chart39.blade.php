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
                <p>
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
 