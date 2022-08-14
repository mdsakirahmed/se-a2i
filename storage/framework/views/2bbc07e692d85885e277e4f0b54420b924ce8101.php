<?php $__env->startSection('content'); ?>
<section id="about">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    <?php echo e(__('About')); ?>

                </h3>
            </header>
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-70">
                    <h5 class="c-primary fw-bold">The National Socioeconomic Dashboard</h4>
                        <p class="mb-md-4">
                            is a policy-making critical tool that serves as a nexus between
                            policymakers and practitioners. It leverages government datasets to work as decision-making action items
                            that can be time-sensitive as well as demand driven through modular and intuitive visualizations.
                            The project is born of a goal to make official data on Bangladesh more accessible and easy-to-digest—to
                            make their insights seamlessly integrate into important policy conversations.
                        </p>
                        <h5 class="c-secondary fw-bold">Bangladesh</h5>
                        <p>
                            is advancing in Sustainable Development Goals (SDGs). The aim of the Socioeconomic Dashboard is
                            to accelerate the growth of SDGs by assisting in policy implicating decision making. The dashboard will
                            serve the stakeholders in all sectors identified by experts that have a demand-driven approach to it.
                        </p>
                    </div>
                    <div class="block-30">
                        <img src="<?php echo e(asset('assets/img/about.png')); ?>" />
                    </div>
                </div>
            </div>
            <div class="card-primary">
                <p>
                    The poverty rate of Bangladesh fell by 1.3% points to 20.5% in FY-2019 which was estimated in FY-2018
                    as 21.8% (Source: Bangladesh Bureau of Statistics, 2019).
                </p>
            </div>
            <div id="dataConcept">
                <header>
                    <h3>
                        Data and Policy Making Concept
                    </h3>
                </header>
                <div class="block-group mt-5">
                    <div class="block">
                        <div class="desktop">
                            <img src="<?php echo e(asset('assets/img/demo.png')); ?>" />
                        </div>
                        <div class="mobile">
                            <img src="<?php echo e(asset('assets/img/demo-moblie.png')); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart37')->html();
} elseif ($_instance->childHasBeenRendered('X8cHdPP')) {
    $componentId = $_instance->getRenderedChildComponentId('X8cHdPP');
    $componentTag = $_instance->getRenderedChildComponentTagName('X8cHdPP');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('X8cHdPP');
} else {
    $response = \Livewire\Livewire::mount('chart37');
    $html = $response->html();
    $_instance->logRenderedChild('X8cHdPP', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart1')->html();
} elseif ($_instance->childHasBeenRendered('xC4NSNw')) {
    $componentId = $_instance->getRenderedChildComponentId('xC4NSNw');
    $componentTag = $_instance->getRenderedChildComponentTagName('xC4NSNw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('xC4NSNw');
} else {
    $response = \Livewire\Livewire::mount('chart1');
    $html = $response->html();
    $_instance->logRenderedChild('xC4NSNw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart13')->html();
} elseif ($_instance->childHasBeenRendered('174Tvqc')) {
    $componentId = $_instance->getRenderedChildComponentId('174Tvqc');
    $componentTag = $_instance->getRenderedChildComponentTagName('174Tvqc');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('174Tvqc');
} else {
    $response = \Livewire\Livewire::mount('chart13');
    $html = $response->html();
    $_instance->logRenderedChild('174Tvqc', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('chart18')->html();
} elseif ($_instance->childHasBeenRendered('qLYTnxr')) {
    $componentId = $_instance->getRenderedChildComponentId('qLYTnxr');
    $componentTag = $_instance->getRenderedChildComponentTagName('qLYTnxr');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qLYTnxr');
} else {
    $response = \Livewire\Livewire::mount('chart18');
    $html = $response->html();
    $_instance->logRenderedChild('qLYTnxr', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/design/resources/views/backend/about.blade.php ENDPATH**/ ?>