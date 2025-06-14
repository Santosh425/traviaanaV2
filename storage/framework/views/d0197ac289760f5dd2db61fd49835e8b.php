
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(!empty($recovery) ? __('Recovery') : __("All Events")); ?></h1>
            <div class="title-actions">
                <?php if(empty($recovery)): ?>
                <a href="<?php echo e(route('event.admin.create')); ?>" class="btn btn-primary"><?php echo e(__("Add new event")); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                <?php if(!empty($rows)): ?>
                    <form method="post" action="<?php echo e(route('event.admin.bulkEdit')); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                        <?php echo e(csrf_field()); ?>

                        <select name="action" class="form-control">
                            <option value=""><?php echo e(__(" Bulk Actions ")); ?></option>

                            <?php if(!empty($recovery)): ?>
                                <option value="recovery"><?php echo e(__(" Recovery ")); ?></option>
                                <option value="permanently_delete"><?php echo e(__("Permanently delete")); ?></option>
                            <?php else: ?>
                                <option value="publish"><?php echo e(__(" Publish ")); ?></option>
                                <option value="draft"><?php echo e(__(" Move to Draft ")); ?></option>
                                <option value="pending"><?php echo e(__("Move to Pending")); ?></option>
                                <option value="clone"><?php echo e(__(" Clone ")); ?></option>
                                <option value="delete"><?php echo e(__(" Delete ")); ?></option>
                            <?php endif; ?>
                        </select>
                        <button data-confirm="<?php echo e(__("Do you want to delete?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Apply')); ?></button>
                    </form>
                <?php endif; ?>
            </div>
            <div class="col-left dropdown">
                <form method="get" action="<?php echo e(!empty($recovery) ? route('event.admin.recovery') : route('event.admin.index')); ?>" class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <?php if(!empty($rows) and $event_manage_others): ?>
                        <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Search by name')); ?>" class="form-control">
                        <div class="ml-3 position-relative">
                            <button class="btn btn-secondary dropdown-toggle bc-dropdown-toggle-filter" type="button" id="dropdown_filters">
                                <?php echo e(__("Advanced")); ?>

                            </button>
                            <div class="dropdown-menu px-3 py-3 dropdown-menu-right" aria-labelledby="dropdown_filters">
                                <?php echo $__env->make("Core::admin.global.advanced-filter", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <button class="btn-info btn btn-icon btn_search" type="submit"><?php echo e(__('Search')); ?></button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i><?php echo e(__('Found :total items',['total'=>$rows->total()])); ?></i></p>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th> <?php echo e(__('Name')); ?></th>
                            <th width="200px"> <?php echo e(__('Location')); ?></th>
                            <th width="130px"> <?php echo e(__('Author')); ?></th>
                            <th width="100px"> <?php echo e(__('Status')); ?></th>
                            <th width="100px"> <?php echo e(__('Reviews')); ?></th>
                            <th width="100px"> <?php echo e(__('Date')); ?></th>
                            <th width="100px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($rows->total() > 0): ?>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($row->status); ?>">
                                    <td><input type="checkbox" name="ids[]" class="check-item" value="<?php echo e($row->id); ?>">
                                    </td>
                                    <td class="title">
                                        <?php if($row->is_featured): ?>
                                            <span class="badge badge-primary"><?php echo e(__("Featured")); ?></span>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('event.admin.edit',['id'=>$row->id])); ?>"><?php echo e($row->title); ?></a>
                                    </td>
                                    <td><?php echo e($row->location->name ?? ''); ?></td>
                                    <td>
                                        <?php if(!empty($row->author)): ?>
                                            <?php echo e($row->author->getDisplayName()); ?>

                                        <?php else: ?>
                                            <?php echo e(__("[Author Deleted]")); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><span class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span></td>
                                    <td>
                                        <a target="_blank" href="<?php echo e(route('review.admin.index',['service_id'=>$row->id])); ?>" class="review-count-approved">
                                            <?php echo e($row->getNumberReviewsInService()); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e(display_date($row->updated_at)); ?></td>
                                    <td>
                                        <?php if(empty($recovery)): ?>
                                            <a href="<?php echo e(route('event.admin.edit',['id'=>$row->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> <?php echo e(__('Edit')); ?></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><?php echo e(__("No event found")); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                </form>
                <?php echo e($rows->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529938690/domains/traviaana.com/public_html/modules/Event/Views/admin/index.blade.php ENDPATH**/ ?>