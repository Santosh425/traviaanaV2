<section class="pt-40">
    <div class="container">
        <div class="row y-gap-15 justify-between items-end">
            <div class="col-auto">
                <h1 class="text-30 fw-600"><?php echo clean($translation->title); ?></h1>

                <div class="row x-gap-20 y-gap-20 items-center pt-10">
                    <?php if(setting_item('tour_enable_review')): ?>
                        <div class="col-auto">
                            <?php $reviewData = $row->getScoreReview(); $score_total = $reviewData['score_total'];?>
                            <?php echo $__env->make('Layout::common.rating',['score_total'=>$score_total], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="col-auto">
                            <div class="text-14 lh-14 text-light-1">
                                <?php if($reviewData['total_review'] > 1): ?>
                                    <?php echo e(__(":number Reviews",["number"=>$reviewData['total_review'] ])); ?>

                                <?php else: ?>
                                    <?php echo e(__(":number Review",["number"=>$reviewData['total_review'] ])); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-auto">
                        <div class="row x-gap-10 items-center">
                            <div class="col-auto">
                                <div class="d-flex x-gap-5 items-center">
                                    <i class="icon-placeholder text-16 text-light-1"></i>
                                    <div class="text-15 text-light-1"><?php echo e($translation->address); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                <div class="row x-gap-10 y-gap-10">
                    <div class="col-auto">
                        <div class="dropdown">
                            <button class="button px-15 py-10 -blue-1 dropdown-toggle" type="button" id="dropdownMenuShare" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-share mr-10"></i>
                                <?php echo e(__('Share')); ?>

                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuShare">
                                <a class="dropdown-item facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" rel="noopener" original-title="<?php echo e(__("Facebook")); ?>">
                                    <i class="fa fa-facebook"></i> <?php echo e(__('Facebook')); ?>

                                </a>
                                <a class="dropdown-item twitter" href="https://twitter.com/share?url=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" rel="noopener" original-title="<?php echo e(__("Twitter")); ?>">
                                    <i class="fa fa-twitter"></i> <?php echo e(__('Twitter')); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="service-wishlist <?php echo e($row->isWishList()); ?>" data-id="<?php echo e($row->id); ?>" data-type="<?php echo e($row->type); ?>">
                            <button class="button px-15 py-10 -blue-1 bg-light-2">
                                <i class="icon-heart mr-10"></i>
                                <?php echo e(__('Save')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-40 js-pin-container">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-lg-8">
                <?php if($row->getGallery()): ?>
                    <div class="relative d-flex justify-center overflow-hidden js-section-slider" data-slider-cols="base-1" data-nav-prev="js-img-prev" data-nav-next="js-img-next">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $row->getGallery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key > 3): ?> <?php break; ?> <?php endif; ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo e($item['large']); ?>" alt="<?php echo e(__("Gallery")); ?>" class="rounded-4 col-12 h-full object-cover">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="absolute h-full col-11">
                            <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-img-prev">
                                <i class="icon icon-chevron-left text-12"></i>
                            </button>
                            <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-img-next">
                                <i class="icon icon-chevron-right text-12"></i>
                            </button>
                        </div>
                        <div class="absolute h-full col-12 z-2 px-20 py-20 d-flex justify-end items-end gotrip-banner">
                            <div class="btn-group">
                                <?php if($row->video): ?>
                                    <a href="#" class="btn btn-transparent has-icon bravo-video-popup" data-toggle="modal" data-src="<?php echo e(handleVideoUrl($row->video)); ?>" data-target="#myModal">
                                        <i class="input-icon field-icon fa">
                                            <svg height="18px" width="18px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                                            <g fill="#FFFFFF">
                                                <path d="M2.25,24C1.009,24,0,22.991,0,21.75V2.25C0,1.009,1.009,0,2.25,0h19.5C22.991,0,24,1.009,24,2.25v19.5
                                                    c0,1.241-1.009,2.25-2.25,2.25H2.25z M2.25,1.5C1.836,1.5,1.5,1.836,1.5,2.25v19.5c0,0.414,0.336,0.75,0.75,0.75h19.5
                                                    c0.414,0,0.75-0.336,0.75-0.75V2.25c0-0.414-0.336-0.75-0.75-0.75H2.25z">
                                                </path>
                                                <path d="M9.857,16.5c-0.173,0-0.345-0.028-0.511-0.084C8.94,16.281,8.61,15.994,8.419,15.61c-0.11-0.221-0.169-0.469-0.169-0.716
                                                    V9.106C8.25,8.22,8.97,7.5,9.856,7.5c0.247,0,0.495,0.058,0.716,0.169l5.79,2.896c0.792,0.395,1.114,1.361,0.719,2.153
                                                    c-0.154,0.309-0.41,0.565-0.719,0.719l-5.788,2.895C10.348,16.443,10.107,16.5,9.857,16.5z M9.856,9C9.798,9,9.75,9.047,9.75,9.106
                                                    v5.788c0,0.016,0.004,0.033,0.011,0.047c0.013,0.027,0.034,0.044,0.061,0.054C9.834,14.998,9.845,15,9.856,15
                                                    c0.016,0,0.032-0.004,0.047-0.011l5.788-2.895c0.02-0.01,0.038-0.027,0.047-0.047c0.026-0.052,0.005-0.115-0.047-0.141l-5.79-2.895
                                                    C9.889,9.004,9.872,9,9.856,9z">
                                                </path>
                                            </g>
                                        </svg>
                                        </i><?php echo e(__("Tour Video")); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php if(count($row->getGallery()) > 4): ?>
                                <?php $__currentLoopData = $row->getGallery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($key == 0): ?>
                                        <a href="<?php echo e($item['large']); ?>" class="button -blue-1 px-24 py-15 bg-white text-dark-1 js-gallery" data-gallery="gallery2">
                                            <?php echo e(__('See All :count Photos',['count'=>count($row->getGallery())])); ?>

                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e($item['large']); ?>" class="js-gallery" data-gallery="gallery2"></a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <h3 class="text-22 fw-500 mt-30">
                    <?php echo e(__('Tour snapshot')); ?>

                </h3>
                <div class="row y-gap-30 justify-between pt-20">
                    <?php if($row->duration): ?>
                    <div class="col-md-auto col-6">
                        <div class="d-flex">
                            <i class="icon-clock text-22 text-blue-1 mr-10"></i>
                            <div class="text-15 lh-15">
                                <?php echo e(__('Duration')); ?>:<br> <?php echo e(duration_format($row->duration,true)); ?>

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if($row->max_people): ?>
                    <div class="col-md-auto col-6">
                        <div class="d-flex">
                            <i class="icon-customer text-22 text-blue-1 mr-10"></i>
                            <div class="text-15 lh-15">
                                <?php echo e(__("Group Size")); ?>:<br>
                                <?php if($row->max_people > 1): ?>
                                    <?php echo e(__(":number persons",array('number'=>$row->max_people))); ?>

                                <?php else: ?>
                                    <?php echo e(__(":number person",array('number'=>$row->max_people))); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($row->location->name)): ?>
                        <?php $location =  $row->location->translate() ?>
                    <div class="col-md-auto col-6">
                        <div class="d-flex">
                            <i class="icon-location text-22 text-blue-1 mr-10"></i>
                            <div class="text-15 lh-15">
                                <?php echo e(__('Location')); ?>:<br> <?php echo e($location->name ?? ''); ?>

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($row->category_tour->name)): ?>
                        <?php $cat =  $row->category_tour->translate() ?>
                    <div class="col-md-auto col-6">
                        <div class="d-flex">
                            <i class="icon-route text-22 text-blue-1 mr-10"></i>
                            <div class="text-15 lh-15">
                                <?php echo e(__("Tour Type")); ?>: <br><?php echo e($cat->name ?? ''); ?>

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
                <div class="border-top-light mt-40 mb-40"></div>
                <div class="row x-gap-40 y-gap-40 gotrip-overview">
                    <div class="col-12">
                        <h3 class="text-22 fw-500"><?php echo e(__('Overview')); ?></h3>
                        <div class="text-dark-1 text-15 mt-20 content-text">
                            <?php echo clean($translation->content); ?>

                        </div>
                        <span class="d-none btn-showmore pointer text-14 text-blue-1 fw-500 underline mt-10">
                            <?php echo e(__("Show More")); ?>

                        </span>
                    </div>
                </div>
                <div class="mt-40 border-top-light">
                    <div class="row x-gap-40 y-gap-40 pt-40">
                        <div class="col-12">
                            <?php echo $__env->make('Tour::frontend.layouts.details.tour-include-exclude', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <?php echo $__env->make('Tour::frontend.layouts.details.tour-form-book', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</section>

<section class="pt-40 pb-20">
    <div class="container">
        <div class="pt-40 border-top-light">
            <div class="row x-gap-40 y-gap-40">
                <div class="col-auto">
                    <h3 class="text-22 fw-500"><?php echo e(__('Important information')); ?></h3>
                </div>
            </div>
            <div class="row x-gap-40 y-gap-40 pt-20">
                <?php echo $__env->make('Tour::frontend.layouts.details.tour-attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <?php if ($__env->exists("Layout::common.detail.surrounding",['line_top'=>true])) echo $__env->make("Layout::common.detail.surrounding",['line_top'=>true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<div class="container mt-40 mb-40">
    <div class="border-top-light"></div>
</div>

<section>
    <div class="container">
        <h3 class="text-22 fw-500 mb-20"><?php echo e(__('Itinerary')); ?></h3>

        <div class="row y-gap-30">
            <div class="col-lg-4">
                <?php echo $__env->make('Tour::frontend.layouts.details.tour-itinerary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>

            <div class="col-lg-8">
                <?php if(!empty($row->location->name)): ?>
                    <?php $location =  $row->location->translate() ?>
                    <?php if($row->map_lat && $row->map_lng): ?>
                        <div class="g-location">
                            <div class="location-map">
                                <div id="map_content" class="map rounded-4" style="min-height: 700px"></div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div class="container mt-40 mb-40">
    <div class="border-top-light"></div>
</div>

<section>
    <div class="container">
        <div class="row y-gap-20">
            <div class="col-lg-4">
                <h2 class="text-22 fw-500"><?php echo e(__('FAQs about')); ?><br> <?php echo clean($translation->title); ?></h2>
            </div>

            <div class="col-lg-8">
                <?php echo $__env->make('Tour::frontend.layouts.details.tour-faqs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
    </div>
</section>

<div class="container mt-40 mb-40">
    <div class="border-top-light"></div>
</div>


<div class="container">
    <div class="video_popup_modal">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item bravo_embed_video" src="" allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/rishikesh/project/traviaana/themes/GoTrip/Tour/Views/frontend/layouts/details/tour-detail.blade.php ENDPATH**/ ?>