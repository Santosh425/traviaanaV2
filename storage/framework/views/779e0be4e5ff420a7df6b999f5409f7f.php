<li class="d-flex flex-column border-0 mb-0">
    <div class="text-20 fw-500 mb-15"><?php echo e(__('Do you have a promo code?')); ?></div>
    <div class="section-coupon-form">
        <?php if(in_array($booking->status , ['draft'])): ?>
            <div class="form-input ">
                <input type="text" name="coupon_code" value="">
                <label class="lh-1 text-16 text-light-1"><?php echo e(__('Enter promo code')); ?></label>
            </div>
            <button class="button -outline-blue-1 text-blue-1 px-30 py-15 mt-20 bravo_apply_coupon">
                <?php echo e(__("Apply")); ?>

                <i class="fa fa-spin fa-spinner d-none"></i>
            </button>
        <?php endif; ?>
        <?php if(!empty($booking->coupons)): ?>
            <ul class="p-0 mb-3 list-coupons">
                <?php $__currentLoopData = $booking->coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="item">
                        <div class="label">
                            <?php echo e($item->coupon_data['code']); ?>

                            <i data-toggle="tooltip" data-placement="top" class="icofont-info-circle" data-original-title="<?php echo e($item->coupon_data['name']); ?>"></i>
                        </div>
                        <div class="val">
                            -<?php echo e(format_money( $item->coupon_amount )); ?>

                            <?php if(in_array($booking->status , ['draft'])): ?>
                                <a href="#" data-code="<?php echo e($item->coupon_code); ?>" class="text-danger text-decoration-none bravo_remove_coupon">
                                <?php echo e(__("[Remove]")); ?>

                                <i class="fa fa-spin fa-spinner d-none"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
        <div class="message alert-text mt-2"></div>
    </div>
</li>
<?php /**PATH /home/rishikesh/project/traviaana/themes/GoTrip/Coupon/Views/frontend/booking/checkout-coupon.blade.php ENDPATH**/ ?>