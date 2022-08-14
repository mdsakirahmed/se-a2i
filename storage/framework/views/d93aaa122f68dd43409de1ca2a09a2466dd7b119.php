<div>
    <div class="card">
        <div class="card-header">
            <?php echo e($name); ?>

        </div>
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="chart_id_<?php echo e($chart_id); ?>"></div>
                <p class="text-center">
                    <button type="butto" class="btn btn-secondary btn-sm m-2" wire:click="$emit('editChartInfo', '<?php echo e($chart_id); ?>')">Edit</button>
                </p>
            </figure>
        </div>
        <div class="card-footer">
            <?php echo $description; ?>

        </div>
    </div>
    
    <script>
        Highcharts.chart("chart_id_<?php echo e($chart_id); ?>", <?php echo collect($chart_data_set); ?>);
    </script>
</div>
<?php /**PATH /var/www/html/design/resources/views/livewire/chart1.blade.php ENDPATH**/ ?>