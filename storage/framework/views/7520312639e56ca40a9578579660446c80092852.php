<div>
    <div class="card">
        <div class="card-header">
            <?php echo e($name); ?>

        </div>
        <div class="card-body">
            <iframe width="100%" height="660px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/Districtwiseremittance/Dashboard1?%3Aembed=y&amp;%3AshowVizHome=no&amp;:device=desktop">
            </iframe>
            <p class="text-center">
                <button type="butto" class="btn btn-secondary btn-sm m-2" wire:click="$emit('editChartInfo', '<?php echo e($chart->id); ?>')">Edit</button>
            </p>
        </div>
        <div class="card-footer">
            <?php echo $description; ?>

        </div>
    </div>
</div>
<?php /**PATH /var/www/html/design/resources/views/livewire/chart17.blade.php ENDPATH**/ ?>