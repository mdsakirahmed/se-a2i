<div>
    <div class="card">
        <div class="card-header">
            <?php echo e($name); ?>

            <div>
                <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '<?php echo e($chart_id); ?>')"><i class="bx bx-edit-alt"></i> Edit</button>
            </div>
        </div>
        <div class="card-body">
            <iframe width="100%" height="660px" frameborder="0" allowFullScreen="true" src="https://public.tableau.com/views/broadsectoralgdp/Dashboard1?%3Aembed=y&amp;%3AshowVizHome=no&:device=desktop">
            </iframe>
        </div>
        <div class="card-footer">
            <?php echo $description; ?>

        </div>
    </div>
</div>
<?php /**PATH /var/www/html/design/resources/views/livewire/chart15.blade.php ENDPATH**/ ?>