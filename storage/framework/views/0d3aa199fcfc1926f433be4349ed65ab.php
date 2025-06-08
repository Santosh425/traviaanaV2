
<?php $__env->startSection('content'); ?>
    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">
            <h1 class="text-30 lh-14 fw-600"><?php echo e(__("Manage Coupon")); ?></h1>
            <div class="text-15 text-light-1"><?php echo e(__("Lorem ipsum dolor sit amet, consectetur.")); ?></div>
        </div>
        <div class="col-auto">
            <?php if(Auth::user()->hasPermission('coupon_create') && empty($recovery)): ?>
                <a href="<?php echo e(route("coupon.vendor.create")); ?>" class="button h-50 px-24 -dark-1 bg-blue-1 text-white"><?php echo e(__("Add Coupon")); ?> <div class="icon-arrow-top-right ml-15"></div></a>
            <?php endif; ?>
        </div>
    </div>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th> <?php echo e(__('Code')); ?></th>
                                            <th> <?php echo e(__('Name')); ?></th>
                                            <th> <?php echo e(__('Amount')); ?></th>
                                            <th> <?php echo e(__('Discount Type')); ?></th>
                                            <th> <?php echo e(__('End Date')); ?></th>
                                            <th width="70px"> <?php echo e(__('Status')); ?></th>
                                            <th width="200px"> <?php echo e(__("Action")); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($rows->total() > 0): ?>
                                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="<?php echo e($row->status); ?>">
                                                    <td class="title">
                                                        <strong><?php echo e($row->code); ?></strong>
                                                    </td>
                                                    <td><?php echo e($row->name); ?></td>
                                                    <td><?php echo e($row->amount); ?></td>
                                                    <td><?php echo e($row->discount_type == 'percent' ? __("Percent") : __("Amount")); ?></td>
                                                    <td><?php echo e(($row->end_date)); ?></td>
                                                    <td><span class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="<?php echo e(route('coupon.vendor.edit',['id'=>$row->id])); ?>" class="btn btn-sm btn-primary btn-info-booking mt-1 mr-1"><?php echo e(__('Edit')); ?></a>
                                                            <a href="<?php echo e(route('coupon.vendor.delete',['id'=>$row->id])); ?>" class="btn btn-sm btn-secondary btn-info-booking mt-1"><?php echo e(__('Delete')); ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6"><?php echo e(__("No data")); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <div class="bravo-pagination">
                            <span class="count-string mb-2"><?php echo e(__("Showing :from - :to of :total coupon",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></span>
                            <?php echo e($rows->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529938690/domains/traviaana.com/public_html/themes/GoTrip/Coupon/Views/frontend/vendor/index.blade.php ENDPATH**/ ?>