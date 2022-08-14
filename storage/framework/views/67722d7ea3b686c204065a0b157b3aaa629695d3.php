<?php $__env->startSection('content'); ?>
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    <?php echo e(__('Economy')); ?>

                </h3>
            </header>
            <div class="row">
                <div class="col-md-6">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart28')->html();
} elseif ($_instance->childHasBeenRendered('kLgV9DU')) {
    $componentId = $_instance->getRenderedChildComponentId('kLgV9DU');
    $componentTag = $_instance->getRenderedChildComponentTagName('kLgV9DU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kLgV9DU');
} else {
    $response = \Livewire\Livewire::mount('chart28');
    $html = $response->html();
    $_instance->logRenderedChild('kLgV9DU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="col-md-6">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart29')->html();
} elseif ($_instance->childHasBeenRendered('qCyUStf')) {
    $componentId = $_instance->getRenderedChildComponentId('qCyUStf');
    $componentTag = $_instance->getRenderedChildComponentTagName('qCyUStf');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qCyUStf');
} else {
    $response = \Livewire\Livewire::mount('chart29');
    $html = $response->html();
    $_instance->logRenderedChild('qCyUStf', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="col-md-6">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart30')->html();
} elseif ($_instance->childHasBeenRendered('c2rAaE5')) {
    $componentId = $_instance->getRenderedChildComponentId('c2rAaE5');
    $componentTag = $_instance->getRenderedChildComponentTagName('c2rAaE5');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('c2rAaE5');
} else {
    $response = \Livewire\Livewire::mount('chart30');
    $html = $response->html();
    $_instance->logRenderedChild('c2rAaE5', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/design/resources/views/backend/economy/banking-and-finance.blade.php ENDPATH**/ ?>