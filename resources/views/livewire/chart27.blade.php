<div>
    <div class="card">
        <div class="card-header">
            {{ $name }}
            <div>
                <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>
            </div>
        </div>
        <div class="card-body">
            <iframe width="100%" height="1150px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/commoditywiseexport2/Dashboard1?%3Aembed=y&%3AshowVizHome=no&:device=desktop">
            </iframe>
        
        </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
    </div>
</div>
