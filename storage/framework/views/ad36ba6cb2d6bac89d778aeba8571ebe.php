<?php
    $terms_ids = $row->terms->pluck('term_id');
    $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
?>
<?php if(!empty($terms_ids) and !empty($attributes)): ?>
    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $translate_attribute = $attribute['parent']->translate() ?>
        <?php if(empty($attribute['parent']['hide_in_single'])): ?>
            <div class="col-12 g-attributes <?php echo e($attribute['parent']->slug); ?> attr-<?php echo e($attribute['parent']->id); ?>">
                <h5 class="d-flex items-center text-16 fw-500">
                    <?php echo e($translate_attribute->name); ?>

                </h5>
                <?php $terms = $attribute['child'] ?>
                <div class="list-disc row x-gap-40 text-15 mt-10 <?php echo e($attribute['parent']['display_type'] ?? ""); ?>">
                    <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $translate_term = $term->translate() ?>
                        <div class="item col-md-3 col-6 <?php echo e($term->slug); ?> term-<?php echo e($term->id); ?>">
                            <?php if(!empty($term->image_id)): ?>
                                <?php $image_url = get_file_url($term->image_id, 'full'); ?>
                                <img src="<?php echo e($image_url); ?>" class="img-responsive" alt="<?php echo e($translate_term->name); ?>">
                            <?php else: ?>
                                <i class="<?php echo e($term->icon ?? "icofont-check-circled icon-default"); ?>"></i>
                            <?php endif; ?>
                            <?php echo e($translate_term->name); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /home/u529938690/domains/traviaana.com/public_html/themes/GoTrip/Boat/Views/frontend/layouts/details/attributes.blade.php ENDPATH**/ ?>