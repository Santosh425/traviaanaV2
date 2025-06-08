
<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('themes/gotrip/dist/frontend/module/booking/css/checkout.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo-booking-page padding-content padding-content pt-40 pb-40" >
        <div class="container">
            <?php echo $__env->make('Booking::frontend/global/booking-detail-notice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row booking-success-detail">
                <div class="col-md-8">
                    <?php echo $__env->make($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="d-flex justify-content-center pt-sm-4 pt-md-0">
                        <div class="col-auto"></div>
                        <div class="col-auto">
                            <a href="<?php echo e(route('user.booking_history')); ?>" class="button h-60 px-24 -dark-1 bg-blue-1 text-white">
                                <?php echo e(__('Booking History')); ?>

                                <div class="icon-arrow-top-right ml-15"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php echo $__env->make($service->checkout_booking_detail_file ?? '',['disable_lazyload'=>1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rishikesh/project/traviaana/themes/GoTrip/Booking/Views/frontend/detail.blade.php ENDPATH**/ ?>