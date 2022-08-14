<?php $__env->startSection('content'); ?>
<section id="overviewOftheEconomy">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    <?php echo e(__('Economy')); ?>

                </h3>
            </header>
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-60">
                        <p class="mb-md-4">
                            <span class="c-secondary fw-bold">The Economy of Bangladesh</span>,
                            is characterised as a developing market economy. It is the 41st largest in the world in nominal terms or at current prices, 
                            and 30th largest by purchasing power parity, international dollars at current prices. It is classified among the Next Eleven 
                            emerging market middle income economies and a frontier market. In the first quarter of 2019, 
                            Bangladesh's was the world's seventh fastest-growing economy with a real GDP or GDP at constant prices annual growth rate of 8.3%. 
                            Dhaka and Chattogram are the principal financial centres of the country, 
                            being home to the Dhaka Stock Exchange and the Chattogram Stock Exchange. 
                            The financial sector of Bangladesh is the second largest in the Indian subcontinent. 
                            Bangladesh is one of the fastest growing economies in the world and South Asia.
                        </p>
                        <p>
                            <span class="c-primary fw-bold">Bangladesh</span>
                            is strategically important for the economies of Nepal and Bhutan, 
                            as Bangladeshi seaports provide maritime access for these landlocked regions and countries.
                            China also views Bangladesh as a potential gateway for its landlocked southwest, 
                            including Tibet, Sichuan and Yunnan.
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="<?php echo e(asset('assets/img/economy.png')); ?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart12')->html();
} elseif ($_instance->childHasBeenRendered('HdMSIE0')) {
    $componentId = $_instance->getRenderedChildComponentId('HdMSIE0');
    $componentTag = $_instance->getRenderedChildComponentTagName('HdMSIE0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('HdMSIE0');
} else {
    $response = \Livewire\Livewire::mount('chart12');
    $html = $response->html();
    $_instance->logRenderedChild('HdMSIE0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="col-md-12">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart13')->html();
} elseif ($_instance->childHasBeenRendered('c3hmzCo')) {
    $componentId = $_instance->getRenderedChildComponentId('c3hmzCo');
    $componentTag = $_instance->getRenderedChildComponentTagName('c3hmzCo');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('c3hmzCo');
} else {
    $response = \Livewire\Livewire::mount('chart13');
    $html = $response->html();
    $_instance->logRenderedChild('c3hmzCo', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="col-md-12">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart14')->html();
} elseif ($_instance->childHasBeenRendered('JLrtnfy')) {
    $componentId = $_instance->getRenderedChildComponentId('JLrtnfy');
    $componentTag = $_instance->getRenderedChildComponentTagName('JLrtnfy');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('JLrtnfy');
} else {
    $response = \Livewire\Livewire::mount('chart14');
    $html = $response->html();
    $_instance->logRenderedChild('JLrtnfy', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="col-md-12">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart15')->html();
} elseif ($_instance->childHasBeenRendered('Jilpko6')) {
    $componentId = $_instance->getRenderedChildComponentId('Jilpko6');
    $componentTag = $_instance->getRenderedChildComponentTagName('Jilpko6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Jilpko6');
} else {
    $response = \Livewire\Livewire::mount('chart15');
    $html = $response->html();
    $_instance->logRenderedChild('Jilpko6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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

<?php echo $__env->make('layouts.backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/design/resources/views/backend/economy/overview-of-the-economy.blade.php ENDPATH**/ ?>