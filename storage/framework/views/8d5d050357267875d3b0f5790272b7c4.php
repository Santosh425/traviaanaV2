

<?php $__env->startSection('title', __('Server Error')); ?>
<?php $__env->startSection('code', '500'); ?>
<?php $__env->startSection('message', __('Server Error')); ?>
<?php $__env->startSection('image',asset('images/404.svg')); ?>
<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/santoshshinde/Downloads/travinana 2025/traviaana/themes/GoTrip/resources/views/errors/500.blade.php ENDPATH**/ ?>