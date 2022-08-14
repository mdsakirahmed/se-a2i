<div>
   <div class="card">
        <div class="card-header">
            <?php echo e($name); ?>

            <div><button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '<?php echo e($chart_id); ?>')"><i class="bx bx-edit-alt"></i> Edit</button></div>
        </div>
        <div class="card-body">
            <figure class="highcharts-figure" wire:ignore>
                <div id="chart_id_<?php echo e($chart->id); ?>"> </div>
            </figure>
            <button type="butto" class="btn  <?php if($chart_type == 'pie'): ?> btn-success <?php else: ?> btn-secondary <?php endif; ?> btn-sm m-2" wire:click="change_chart_type('pie')">Pie</button>
            <button type="butto" class="btn  <?php if($chart_type == 'bar'): ?> btn-success <?php else: ?> btn-secondary <?php endif; ?> btn-sm m-2" wire:click="change_chart_type('bar')">Bar</button>
            <button type="butto" class="btn  <?php if($chart_type == 'line'): ?> btn-success <?php else: ?> btn-secondary <?php endif; ?> btn-sm m-2" wire:click="change_chart_type('line')">Line</button>
            <button type="butto" class="btn  <?php if($chart_type == 'area'): ?> btn-success <?php else: ?> btn-secondary <?php endif; ?> btn-sm m-2" wire:click="change_chart_type('area')">Area</button>
        </div>
        <div class="card-footer">
            <?php echo $description; ?>

        </div>
   </div>
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
<?php /**PATH /var/www/html/design/resources/views/livewire/chart32.blade.php ENDPATH**/ ?>