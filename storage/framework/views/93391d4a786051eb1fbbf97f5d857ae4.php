
<?php $__env->startSection('content'); ?>
    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">
            <h1 class="text-30 lh-14 fw-600"><?php echo e(!empty($recovery) ?__('Recovery Flights') : __("Manage Flights")); ?></h1>
            <div class="text-15 text-light-1"><?php echo e(__('Lorem ipsum dolor sit amet, consectetur.')); ?></div>
        </div>
        <div class="col-auto">
            <?php if(Auth::user()->hasPermission('flight_create')&& empty($recovery)): ?>
                <a href="<?php echo e(route("flight.vendor.create")); ?>" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                    <?php echo e(__("Add Flight")); ?> <div class="icon-arrow-top-right ml-15"></div>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($rows->total() > 0): ?>
        <div class="bravo-list-item py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="list-item mt-0">
                <div class="row">
                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12">
                            <?php echo $__env->make('Flight::frontend.manageFlight.loop-list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="bravo-pagination mt-0 mb-0">
                <span class="count-string"><?php echo e(__("Showing :from - :to of :total Flights",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></span>
                <div class="mt-2">
                    <?php echo e($rows->appends(request()->query())->links()); ?>

                </div>
            </div>
        </div>
    <?php else: ?>
        <?php echo e(__("No Flight")); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529938690/domains/traviaana.com/public_html/themes/GoTrip/Flight/Views/frontend/manageFlight/index.blade.php ENDPATH**/ ?>