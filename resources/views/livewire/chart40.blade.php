<div>
    <div class="card">
        <div class="card-header">
            {{ $name }}
        </div>
        <div class="card-body">
            <iframe width="100%" height="660px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/ImplementingMinistry/Dashboard1?%3Aembed=y&%3AshowVizHome=no&:device=desktop">
            </iframe>
            <p class="text-center">
                <button type="butto" class="btn btn-secondary btn-sm m-2" wire:click="$emit('editChartInfo', '{{ $chart->id }}')">Edit</button>
            </p>
        </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
    </div>
</div>
