<?php $__env->startSection('content'); ?>
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    <?php echo e(__('Social Protection')); ?>

                </h3>
            </header>
            <div class="row">
                <div class="col-md-6">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart31')->html();
} elseif ($_instance->childHasBeenRendered('qIKLEck')) {
    $componentId = $_instance->getRenderedChildComponentId('qIKLEck');
    $componentTag = $_instance->getRenderedChildComponentTagName('qIKLEck');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qIKLEck');
} else {
    $response = \Livewire\Livewire::mount('chart31');
    $html = $response->html();
    $_instance->logRenderedChild('qIKLEck', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="col-md-6">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart32')->html();
} elseif ($_instance->childHasBeenRendered('TNGykdi')) {
    $componentId = $_instance->getRenderedChildComponentId('TNGykdi');
    $componentTag = $_instance->getRenderedChildComponentTagName('TNGykdi');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('TNGykdi');
} else {
    $response = \Livewire\Livewire::mount('chart32');
    $html = $response->html();
    $_instance->logRenderedChild('TNGykdi', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="col-md-6">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart33')->html();
} elseif ($_instance->childHasBeenRendered('fjnYz2Q')) {
    $componentId = $_instance->getRenderedChildComponentId('fjnYz2Q');
    $componentTag = $_instance->getRenderedChildComponentTagName('fjnYz2Q');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('fjnYz2Q');
} else {
    $response = \Livewire\Livewire::mount('chart33');
    $html = $response->html();
    $_instance->logRenderedChild('fjnYz2Q', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="col-md-6">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart34')->html();
} elseif ($_instance->childHasBeenRendered('5UQnBEg')) {
    $componentId = $_instance->getRenderedChildComponentId('5UQnBEg');
    $componentTag = $_instance->getRenderedChildComponentTagName('5UQnBEg');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('5UQnBEg');
} else {
    $response = \Livewire\Livewire::mount('chart34');
    $html = $response->html();
    $_instance->logRenderedChild('5UQnBEg', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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


<?php echo $__env->make('layouts.backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/design/resources/views/backend/social-protection/social-protection.blade.php ENDPATH**/ ?>