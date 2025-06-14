<?php
    $style = $style ?? 'default';
    $classes = ' form-search-all-service mainSearch bg-white px-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-4 mt-30';
    $button_classes = " -dark-1 py-15 col-12 bg-blue-1 text-white w-100 rounded-4";
    if($style == 'sidebar'){
        $classes = ' form-search-sidebar';
        $button_classes = " -dark-1 py-15 col-12 bg-blue-1 h-60 text-white w-100 rounded-4";
    }
    if($style == 'normal'){
        $classes = ' px-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-100 form-search-all-service mainSearch -w-900 bg-white';
        $button_classes = " -dark-1 py-15 h-60 col-12 rounded-100 bg-blue-1 text-white w-100";
    }
    if($style == 'normal2'){
        $classes = 'mainSearch bg-white pr-20 py-20 lg:px-20 lg:pt-5 lg:pb-20 rounded-4 shadow-1';
        $button_classes = " -dark-1 py-15 h-60 col-12 rounded-100 bg-blue-1 text-white w-100";
    }
    if($style == 'carousel_v2'){
        $classes = " w-100";
        $button_classes = " -dark-1 py-15 px-35 h-60 col-12 rounded-4 bg-yellow-1 text-dark-1";
    }
    if($style == 'map'){
        $classes = " w-100";
        $button_classes = " -dark-1 size-60 col-12 rounded-4 bg-blue-1 text-white";
    }
    if($style == 'space_form_search'){
        $classes = "form-search-all-service mainSearch bg-white px-20 py-20 lg:px-20 lg:pt-5 lg:pb-20 rounded-100 shadow-2 mt-40 -w-900";
        $button_classes = " -blue-1 py-20 px-35 col-12 rounded-100 bg-dark-4 text-white";
    }
?>
<form action="<?php echo e(route("space.search")); ?>" class="gotrip_form_search bravo_form_search bravo_form form <?php echo e($classes); ?>" method="get">
    <?php if( !empty(Request::query('_layout')) ): ?>
        <input type="hidden" name="_layout" value="<?php echo e(Request::query('_layout')); ?>">
    <?php endif; ?>
    <?php    $search_style = setting_item('space_location_search_style','normal');
            $space_search_fields = setting_item_array('space_search_fields');
            $space_search_fields = array_values(\Illuminate\Support\Arr::sort($space_search_fields, function ($value) {
                return $value['position'] ?? 0;
            }));
    ?>
    <div class="field-items">
        <div class="row w-100 m-0">
            <?php if(!empty($space_search_fields)): ?>
                <?php $__currentLoopData = $space_search_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-<?php echo e($field['size'] ?? "6"); ?> align-self-center px-30 lg:py-20 lg:px-0">
                        <?php $field['title'] = $field['title_'.app()->getLocale()] ?? $field['title'] ?? "" ?>
                        <?php switch($field['field']):
                            case ('service_name'): ?> <?php echo $__env->make('Layout::common.search.fields.service_name', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php break; ?>
                            <?php case ('location'): ?> <?php echo $__env->make('Layout::common.search.fields.location', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php break; ?>
                            <?php case ('date'): ?> <?php echo $__env->make('Layout::common.search.fields.date', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php break; ?>
                            <?php case ('attr'): ?> <?php echo $__env->make('Layout::common.search.fields.attr', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php break; ?>
                            <?php case ('guests'): ?> <?php echo $__env->make('Layout::common.search.fields.guests', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php break; ?>
                        <?php endswitch; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="button-item">
        <button class="mainSearch__submit button <?php echo e($button_classes); ?>" type="submit">
            <i class="icon-search text-20 mr-10"></i>
            <span class="text-search"><?php echo e(__("Search")); ?></span>
        </button>
    </div>
</form>
<?php /**PATH /Users/santoshshinde/Downloads/travinana 2025/traviaana/themes/GoTrip/Space/Views/frontend/layouts/search/form-search.blade.php ENDPATH**/ ?>