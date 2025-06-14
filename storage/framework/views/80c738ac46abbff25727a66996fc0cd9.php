<?php $review_score = $row->review_data ?>
<div class="bravo_single_book_wrap d-flex justify-end js-pin-content" data-offset="120">
    <div class="w-360 lg:w-full d-flex flex-column items-center">
        <?php echo $__env->make('Layout::common.detail.vendor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="bravo_single_book px-30 py-30 rounded-4 border-light bg-white shadow-4">
            <div id="bravo_tour_book_app" v-cloak>
                <div class="row y-gap-15 items-center justify-between">
                    <div class="col-auto">
                        <div class="text-14 text-light-1">
                            <?php echo e(__("From")); ?>

                            <span class="text-14 text-red-1 line-through"><?php echo e($row->display_sale_price); ?></span>
                            <span class="text-20 fw-500 text-dark-1"><?php echo e($row->display_price); ?></span>
                        </div>
                    </div>
                    <?php if($review_score): ?>
                        <div class="col-auto">
                            <div class="d-flex items-center">
                                <div class="text-14 text-right mr-10">
                                    <div class="lh-15 fw-500"><?php echo e($review_score['score_text']); ?></div>
                                    <div class="lh-15 text-light-1">
                                        <?php if($review_score['total_review'] > 1): ?>
                                            <?php echo e(__(":number reviews",["number"=>$review_score['total_review'] ])); ?>

                                        <?php else: ?>
                                            <?php echo e(__(":number review",["number"=>$review_score['total_review'] ])); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="size-40 flex-center bg-blue-1 rounded-4">
                                    <div class="text-14 fw-600 text-white"><?php echo e($review_score['score_total']); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="nav-enquiry" v-if="is_form_enquiry_and_book">
                    <div class="enquiry-item active" >
                        <span><?php echo e(__("Book")); ?></span>
                    </div>
                    <div class="enquiry-item" data-toggle="modal" data-target="#enquiry_form_modal">
                        <span><?php echo e(__("Enquiry")); ?></span>
                    </div>
                </div>
                <div class="form-book">
                    <div class="form-content">
                        <div class="row y-gap-20 pt-20">
                            <div class="col-12">
                                <div class="form-group form-date-field form-date-search clearfix px-20 py-10 border-light rounded-4 -right position-relative" data-format="<?php echo e(get_moment_date_format()); ?>">
                                    <div class="date-wrapper clearfix" @click="openStartDate">
                                        <div class="check-in-wrapper">
                                            <h4 class="text-15 fw-500 ls-2 lh-16"><?php echo e(__("Select Dates")); ?></h4>
                                            <div class="render check-in-render" v-html="start_date_html"></div>
                                            <?php if(!empty($row->min_day_before_booking)): ?>
                                                <div class="render check-in-render">
                                                    <small>
                                                        <?php if($row->min_day_before_booking > 1): ?>
                                                            - <?php echo e(__("Book :number days in advance",["number"=>$row->min_day_before_booking])); ?>

                                                        <?php else: ?>
                                                            - <?php echo e(__("Book :number day in advance",["number"=>$row->min_day_before_booking])); ?>

                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(!empty($row->min_day_stays)): ?>
                                                <div class="render check-in-render">
                                                    <small>
                                                        <?php if($row->min_day_stays > 1): ?>
                                                            - <?php echo e(__("Stay at least :number days",["number"=>$row->min_day_stays])); ?>

                                                        <?php else: ?>
                                                            - <?php echo e(__("Stay at least :number day",["number"=>$row->min_day_stays])); ?>

                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <input type="text" class="start_date" ref="start_date" style="height: 1px;visibility: hidden;position: absolute;left: 0;">
                                </div>
                            </div>

                            <div class="col-12" v-for="(type,index) in person_types" v-if="person_types">
                                <div class="searchMenu-guests px-20 py-10 border-light rounded-4 js-form-dd" :class="{'d-none':type.max==0}">
                                    <div data-x-dd-click="searchMenu-guests">
                                        <h4 class="text-15 fw-500 ls-2 lh-16">{{type.name}}</h4>
                                        <h4 class="text-12 fw-500 ls-2 lh-16">{{type.desc}}</h4>
                                        <h4 class="text-12 fw-400 ls-2 text-light-1">{{type.display_price}} <?php echo e(__("per person")); ?></h4>
                                        <div class="text-15 text-light-1 ls-2 lh-16">
                                            <span class="js-count-adult">{{ type.number }}</span>
                                        </div>
                                    </div>
                                    <div class="searchMenu-guests__field shadow-2 mt-10" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                        <div class="bg-white px-30 py-30 rounded-4">
                                            <div class="row y-gap-10 justify-between items-center form-guest-search">
                                                <div class="col-auto">
                                                    <div class="text-15 fw-500"><?php echo e(__('Number')); ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="d-flex items-center js-counter" data-value-change=".js-count-adult">
                                                        <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-down" @click="minusPersonType(type)">
                                                            <i class="icon-minus text-12"></i>
                                                        </button>
                                                        <span class="input"><input type="number" v-model="type.number" min="1" @change="changePersonType(type)"/></span>
                                                        <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-up" @click="addPersonType(type)">
                                                            <i class="icon-plus text-12"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" v-else>
                                <div class="searchMenu-guests px-20 py-10 border-light rounded-4 js-form-dd">
                                    <div data-x-dd-click="searchMenu-guests">
                                        <h4 class="text-15 fw-500 ls-2 lh-16"><?php echo e(__('Guests')); ?></h4>
                                        <div class="text-15 text-light-1 ls-2 lh-16">
                                            <span class="js-count-adult">{{ number }}</span>
                                        </div>
                                    </div>
                                    <div class="searchMenu-guests__field shadow-2" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                        <div class="bg-white px-30 py-30 rounded-4">
                                            <div class="row y-gap-10 justify-between items-center form-guest-search">
                                                <div class="col-auto">
                                                    <div class="text-15 fw-500"><?php echo e(__('Number')); ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="d-flex items-center js-counter" data-value-change=".js-count-adult">
                                                        <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-down" @click="minusGuestsType()">
                                                            <i class="icon-minus text-12"></i>
                                                        </button>
                                                        <span class="input"><input type="number" v-model="guests" min="1"/></span>
                                                        <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-up" @click="addGuestsType()">
                                                            <i class="icon-plus text-12"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" v-if="extra_price.length">
                                <div class="form-section-group px-20 py-10 border-light rounded-4">
                                    <h4 class="form-section-title text-15 fw-500 ls-2 lh-16"><?php echo e(__('Extra prices:')); ?></h4>
                                    <div class="form-group " v-for="(type,index) in extra_price">
                                        <div class="extra-price-wrap d-flex justify-content-between">
                                            <div class="flex-grow-1">
                                                <label class="d-flex items-center">
                                                    <span class="form-checkbox ">
                                                        <input type="checkbox" true-value="1" false-value="0" v-model="type.enable" style="display: none">
                                                        <span class="form-checkbox__mark">
                                                            <span class="form-checkbox__icon icon-check"></span>
                                                        </span>
                                                    </span>
                                                    <span class="text-15 ml-10">{{type.name}}</span>
                                                </label>
                                            </div>
                                            <div class="flex-shrink-0">{{type.price_html}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" v-if="buyer_fees.length">
                                <div class="form-section-group form-group-padding px-20 py-10 border-light rounded-4">
                                    <div class="extra-price-wrap d-flex justify-content-between" v-for="(type,index) in buyer_fees">
                                        <div class="flex-grow-1">
                                            <label class="text-15">{{type.type_name}}
                                                <i class="fa fa-info-circle" v-if="type.desc" data-bs-toggle="tooltip" data-placement="top" :title="type.type_desc"></i>
                                            </label>
                                            <div class="render" v-if="type.price_type">({{type.price_type}})</div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="unit" v-if='type.unit == "percent"'>
                                                {{ type.price }}%
                                            </div>
                                            <div class="unit" v-else >
                                                {{ formatMoney(type.price) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" v-if="total_price > 0">
                                <ul class="form-section-total list-unstyled px-20 py-10 border-light rounded-4">
                                    <li class="d-flex justify-content-between">
                                        <label class="text-15 fw-500"><?php echo e(__("Total")); ?></label>
                                        <span class="price">{{total_price_html}}</span>
                                    </li>
                                    <li class="d-flex justify-content-between" v-if="is_deposit_ready">
                                        <label for=""><?php echo e(__("Pay now")); ?></label>
                                        <span class="price">{{pay_now_price_html}}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12" v-if="html">
                                <div v-html="html"></div>
                            </div>

                            <div class="col-12">
                                <div class="submit-group">
                                    <p><i>
                                            <?php if($row->max_guests <= 1): ?>
                                                <?php echo e(__(':count Guest in maximum',['count'=>$row->max_guests])); ?>

                                            <?php else: ?>
                                                <?php echo e(__(':count Guests in maximum',['count'=>$row->max_guests])); ?>

                                            <?php endif; ?>
                                        </i>
                                    </p>
                                    <a class="button -dark-1 py-15 px-35 h-60 col-12 rounded-4 bg-blue-1 text-white cursor-pointer" @click="doSubmit($event)" :class="{'disabled':onSubmit,'btn-success':(step == 2),'btn-primary':step == 1}" name="submit">
                                        <span v-if="step == 1"><?php echo e(__("BOOK NOW")); ?></span>
                                        <span v-if="step == 2"><?php echo e(__("Book Now")); ?></span>
                                        <i v-show="onSubmit" class="fa fa-spinner fa-spin"></i>
                                    </a>
                                    <div class="alert-text text-danger mt-10" v-show="message.content" v-html="message.content" :class="{'danger':!message.type,'success':message.type}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex items-center pt-20">
                    <div class="size-40 flex-center bg-light-2 rounded-full">
                        <i class="icon-heart text-16 text-green-2"></i>
                    </div>
                    <div class="text-14 lh-16 ml-10"><?php echo e(__(":number% of travelers recommend this experience",['number'=>$row->recommend_percent])); ?></div>
                </div>
            </div>
        </div>

        <div class="px-30">
            <div class="text-14 text-light-1 mt-30"><?php echo e(__('Not sure? You can cancel this reservation up to 24 hours in advance for a full refund.')); ?></div>
        </div>
    </div>
</div>
<?php echo $__env->make("Booking::frontend.global.enquiry-form",['service_type'=>'tour'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/rishikesh/project/traviaana/themes/GoTrip/Tour/Views/frontend/layouts/details/tour-form-book.blade.php ENDPATH**/ ?>