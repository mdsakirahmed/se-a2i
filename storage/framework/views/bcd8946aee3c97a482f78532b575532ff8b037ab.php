<div>
    
    <div wire:ignore.self class="modal fade" id="chart_edit_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php if($chart): ?>
                <div class="modal-body">
                    <b>Bangla title</b>
                    <p><?php echo e($chart->bn_name); ?></p>
                    <b>English title</b>
                    <p><?php echo e($chart->en_name); ?></p>
                    <hr>
                    <b>Bangla description</b>
                    <p><?php echo $chart->en_description; ?></p>
                    <b>English description</b>
                    <p><?php echo $chart->en_description; ?></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
                <?php else: ?>
                <p class="text-center">
                    <img src="<?php echo e(asset('assets/img/something-went-wrong.png')); ?>" alt="" width="320">
                </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    

    <script>
        window.addEventListener('open_modal', event => {
            $('#chart_edit_modal').modal('show');
        });

    </script>
</div>
<?php /**PATH /var/www/html/design/resources/views/livewire/edit-chart.blade.php ENDPATH**/ ?>