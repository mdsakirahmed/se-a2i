<div class="h-100">
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
            <iframe width="100%" height="1150px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/commoditywiseexport2/Dashboard1?%3Aembed=y&%3AshowVizHome=no&:device=desktop">
            </iframe>
        
        </div>
        <div class="card-footer">
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
</div>
