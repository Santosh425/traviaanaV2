<?php
    $terms_ids = $row->tour_term->pluck('term_id');
    $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
?>
<?php if(!empty($terms_ids) and !empty($attributes)): ?>
    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $translate_attribute = $attribute['parent']->translate() ?>
        <?php if(empty($attribute['parent']['hide_in_single'])): ?>
            <div class="col-lg-4 col-md-6">
                <div class="fw-500 mb-10"><?php echo e($translate_attribute->name); ?></div>
                <?php $terms = $attribute['child'] ?>
                <ul class="list-disc">
                    <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $translate_term = $term->translate() ?>
                        <li>
                            <?php if(!empty($term->image_id)): ?>
                                <?php $image_url = get_file_url($term->image_id, 'full'); ?>
                                <img src="<?php echo e($image_url); ?>" class="img-responsive" alt="<?php echo e($translate_term->name); ?>">
                            <?php else: ?>
                                <?php if($term->icon): ?>
                                    <i class="<?php echo e($term->icon); ?>"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php echo e($translate_term->name); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /home/u529938690/domains/traviaana.com/public_html/themes/GoTrip/Tour/Views/frontend/layouts/details/tour-attributes.blade.php ENDPATH**/ ?>