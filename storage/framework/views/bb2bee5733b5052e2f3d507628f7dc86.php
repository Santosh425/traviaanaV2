<div class="bravo_filter sidebar">
    <?php if($layout == 'grid'): ?>
        <div class="g-filter-item sidebar__item -no-border bravo-form-search mb-30 lg:d-none">
            <div class="px-20 py-20 bg-light-2 rounded-4">
                <h5 class="text-18 fw-500 mb-10"><?php echo e(setting_item_with_lang("space_page_search_title")); ?></h5>
                <?php echo $__env->make('Space::frontend.layouts.search.form-search',['style' => 'sidebar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('space.search')); ?>" class="bravo_form_filter lg:d-none" data-x="filterPopup" data-x-toggle="-is-active">

        <div class="g-filter-item sidebar__item <?php if(!$layout || $layout == 'normal'): ?> -no-border <?php endif; ?> pt-20 mb-30 lg:d-none">
            <div class="flex-center ratio ratio-15:9 js-lazy" data-bg="<?php echo e(get_file_url(setting_item('space_map_image'),'full')); ?>">
                <a href="<?php echo e(route('space.search',['_layout'=>'map'])); ?>" class="button py-15 px-24 -blue-1 bg-white text-dark-1 absolute w-auto h-auto" style="left: initial; top: initial">
                    <i class="icon-destination text-22 mr-10"></i>
                    <?php echo e(__('Show on map')); ?>

                </a>
            </div>
        </div>

        <aside class="sidebar y-gap-40 p-4 p-lg-0">
            <div data-x-click="filterPopup" class="-icon-close is_mobile pb-0">
                <i class="icon-close"></i>
            </div>

            <div class="sidebar__item pb-30 -no-border">
                <h5 class="text-18 fw-500 mb-10"><?php echo e(__('Price')); ?></h5>
                <div class="row x-gap-10 y-gap-30">
                    <div class="col-12">
                        <div class="js-price-searchPage">
                            <div class="text-14 fw-500"></div>
                            <?php
                            $price_min = $pri_from = floor ( App\Currency::convertPrice($space_min_max_price[0]) );
                            $price_max = $pri_to = ceil ( App\Currency::convertPrice($space_min_max_price[1]) );
                            if (!empty($price_range = Request::query('price_range'))) {
                                $pri_from = explode(";", $price_range)[0];
                                $pri_to = explode(";", $price_range)[1];
                            }
                            $currency = App\Currency::getCurrency( App\Currency::getCurrent() );
                            ?>
                            <input type="hidden" class="filter-price irs-hidden-input" name="price_range"
                                   data-symbol=" <?php echo e($currency['symbol'] ?? ''); ?>"
                                   data-min="<?php echo e($price_min); ?>"
                                   data-max="<?php echo e($price_max); ?>"
                                   data-from="<?php echo e($pri_from); ?>"
                                   data-to="<?php echo e($pri_to); ?>"
                                   readonly="" value="<?php echo e($price_range); ?>">
                            <div class="d-flex justify-between mb-20">
                                <div class="text-15 text-dark-1">
                                    <span class="js-lower"></span>
                                    -
                                    <span class="js-upper"></span>
                                </div>
                            </div>
                            <div class="px-5">
                                <div class="js-slider"></div>
                            </div>
                            <button type="submit" class="flex-center bg-blue-1 rounded-4 px-3 py-1 mt-3 text-12 fw-600 text-white btn-apply-price-range mt-20"><?php echo e(__("APPLY")); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="g-filter-item sidebar__item">
                <div class="item-title">
                    <h5 class="text-18 fw-500 mb-10"><?php echo e(__("Review Score")); ?></h5>
                </div>
                <div class="item-content sidebar-checkbox">
                    <?php for($number = 5 ;$number >= 1 ; $number--): ?>
                        <div class="row y-gap-10 items-center justify-between">
                            <div class="col-auto">
                                <div class="d-flex items-center">
                                    <div class="form-checkbox ">
                                        <input type="checkbox" name="review_score[]" <?php if(  in_array($number , request()->query('review_score',[])) ): ?>  checked <?php endif; ?> value="<?php echo e($number); ?>">
                                        <div class="form-checkbox__mark">
                                            <div class="form-checkbox__icon icon-check"></div>
                                        </div>
                                    </div>

                                    <div class="text-15 ml-10">
                                        <?php for($review_score = 1 ;$review_score <= $number ; $review_score++): ?>
                                            <i class="fa fa-star text-yellow-1"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <?php echo $__env->make('Layout::global.search.filters.attrs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="bravo-clear-filter hidden-lg-up" style="display: none;">
                <a href="#" onclick="return false" class="button px-15 py-10 -dark-1 bg-blue-1 text-white">
                    <i class="icon-loop-2 mr-10 text-12"></i>
                    <span><?php echo e(__('Clear All')); ?></span>
                </a>
            </div>
        </aside>
    </form>
</div>


<?php /**PATH /home/u529938690/domains/traviaana.com/public_html/themes/GoTrip/Space/Views/frontend/layouts/search/filter-search.blade.php ENDPATH**/ ?>