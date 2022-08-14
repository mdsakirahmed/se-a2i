<div>
    <div class="card">
        <div class="card-header">
            <?php echo e($name); ?>

        </div>
        <div class="card-body">
            <iframe width="100%" height="660px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/Percentragechangeinoverseasemployment/Dashboard1?%3Aembed=y&%3AshowVizHome=no&:device=desktop">
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
<?php /**PATH /var/www/html/design/resources/views/livewire/chart19.blade.php ENDPATH**/ ?>