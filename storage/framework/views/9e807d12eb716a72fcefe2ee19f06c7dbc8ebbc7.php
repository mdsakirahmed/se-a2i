<div>
   <div class="card">
    <div class="card-header">
        <?php echo e($name); ?>

        <div>
                <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '<?php echo e($chart_id); ?>')"><i class="bx bx-edit-alt"></i> Edit</button>
            </div>
    </div>
   <div class="card-body">
    <figure class="highcharts-figure">
        <div id="chart_id_<?php echo e($chart->id); ?>"> </div>
    </figure>
   </div>
    <div class="card-footer">
        <?php echo $description; ?>

    </div>
   </div>
    <script>
        Highcharts.chart("chart_id_<?php echo e($chart->id); ?>", <?php echo collect($chart_data_set); ?>);
    </script>
</div>
<?php /**PATH /var/www/html/design/resources/views/livewire/chart14.blade.php ENDPATH**/ ?>