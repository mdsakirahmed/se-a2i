<div>
   <div class="card">
    <div class="card-header">
        <?php echo e($name); ?>

        <div>
                <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '<?php echo e($chart_id); ?>')"><i class="bx bx-edit-alt"></i> Edit</button>
            </div>
    </div>
   <div class="card-body">
    <button type="butto" class="btn  <?php if($selected_division == 'All'): ?> btn-success <?php else: ?> btn-secondary <?php endif; ?> btn-sm m-2" wire:click="filterDivision('All')">All</button>
    <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button type="butto" class="btn <?php if($selected_division == $division): ?> btn-success <?php else: ?> btn-secondary <?php endif; ?> btn-sm m-2" wire:click="filterDivision('<?php echo e($division); ?>')"><?php echo e($division); ?></button>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <figure class="highcharts-figure">
        <div id="chart_id_<?php echo e($chart->id); ?>"> </div>
    </figure>
   </div>
    <div class="card-footer">
        <?php echo $description; ?>

    </div>
   </div>
    <script>
    </script>

<script>
    $(document).ready(function () {
        //First loaded data
        Highcharts.chart("chart_id_<?php echo e($chart->id); ?>", <?php echo collect($chart_data_set); ?>);

        //chart update and re-render
        window.addEventListener("chart_update_<?php echo e($chart->id); ?>", event => {
            Highcharts.chart("chart_id_<?php echo e($chart->id); ?>", event.detail.data);
        });
    });
</script>



</div>
<?php /**PATH /var/www/html/design/resources/views/livewire/chart16.blade.php ENDPATH**/ ?>