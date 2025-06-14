
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Flight: :name :code #:id",['name'=>@$currentFlight->title,'code'=>$currentFlight->code,'id'=>$currentFlight->id])); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title"><?php echo e(__("Add Flight Seat")); ?></div>
                    <div class="panel-body">
                        <form action="<?php echo e(route('flight.admin.flight.seat.store',['flight_id'=>$currentFlight->id,'id'=>$row->id??-1])); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('Flight::admin.flight.seat.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="">
                                <button class="btn btn-primary" type="submit"><?php echo e(__("Add new")); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        <?php if(!empty($rows)): ?>
                            <form method="post" action="<?php echo e(route('flight.admin.flight.seat.bulkEdit',['flight_id'=>$currentFlight->id])); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                                <?php echo e(csrf_field()); ?>

                                <select name="action" class="form-control">
                                    <option value=""><?php echo e(__(" Bulk Action ")); ?></option>
                                    <option value="delete"><?php echo e(__(" Delete ")); ?></option>
                                </select>
                                <button data-confirm="<?php echo e(__("Do you want to delete?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Apply')); ?></button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="col-left">
                        <form method="get" action="<?php echo e(route('flight.admin.flight.seat.index',['flight_id'=>$currentFlight->id])); ?> " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                            <input type="text" name="s" value="<?php echo e(Request()->s); ?>" class="form-control" placeholder="<?php echo e(__("Search by code")); ?>">
                            <button class="btn-info btn btn-icon btn_search" id="search-submit" type="submit"><?php echo e(__('Search')); ?></button>
                        </form>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-title"><?php echo e(__("All Flight seat")); ?></div>
                    <div class="panel-body">
                        <form class="bravo-form-item">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th><?php echo e(__("Flight")); ?></th>
                                    <th><?php echo e(__("Seat type")); ?></th>
                                    <th ><?php echo e(__("Price")); ?></th>
                                    <th ><?php echo e(__("Max passengers")); ?></th>
                                    <th class="date"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(count($rows) > 0): ?>
                                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><input type="checkbox" class="check-item" name="ids[]" value="<?php echo e($row->id); ?>"></td>
                                            <td><a href="<?php echo e(route('flight.admin.edit',$row->flight)); ?>"><?php echo e($row->flight->title); ?> <?php echo e($row->flight->code); ?> #<?php echo e($row->flight->id); ?></a></td>
                                            <td><?php echo e($row->seatType->name); ?></td>
                                            <td><?php echo e(format_money($row->price)); ?></td>
                                            <td><?php echo e($row->max_passengers); ?></td>
                                            <td><a class="btn btn-primary btn-sm" href="<?php echo e(route('flight.admin.flight.seat.edit',['flight_id'=>$currentFlight->id,'id'=>$row->id])); ?>"><i class="fa fa-edit"></i> <?php echo e(__('Edit')); ?></a></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4"><?php echo e(__("No data")); ?></td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                                <?php echo e($rows->appends(request()->query())->links()); ?>

                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/rishikesh/project/traviaana/modules/Flight/Views/admin/flight/seat/index.blade.php ENDPATH**/ ?>