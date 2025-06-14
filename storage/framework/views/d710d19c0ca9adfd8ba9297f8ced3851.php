

<?php $__env->startSection('content'); ?>

    <form action="<?php echo e(route('page.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? __('Edit: ') .$translation->title :  __('Add new page')); ?></h1>
                    <?php if($row->slug): ?>
                        <p class="item-url-demo"><?php echo e(__('Permalink: ')); ?> <?php echo e(url((request()->query('lang') ? request()->query('lang').'/' : ''). config('page.page_route_prefix') )); ?>/<a href="#" class="open-edit-input" data-name="slug"><?php echo e($row->slug); ?></a>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if($row->id): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('page.admin.builder',['id'=>$row->id])); ?>"><i class="fa fa-paint-brush"></i> <?php echo e(__('Template Builder')); ?></a>
                    <?php endif; ?>
                    <?php if($row->slug): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e($row->getDetailUrl(request()->query('lang'))); ?>" target="_blank"><?php echo e(__('View page')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if($row->id): ?>
                <?php echo $__env->make('Language::admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title">
                                <strong><?php echo e(__('Page Content')); ?></strong>
                            </div>
                            <div class="panel-body">
                                <div class="form-group magic-field" data-id="title" data-type="title">
                                    <label class="control-label"><?php echo e(__("Title")); ?></label>
                                    <input
                                        type="text"
                                        value="<?php echo e($translation->title); ?>"
                                        placeholder="<?php echo e(__("Title")); ?>"
                                        name="title"
                                        class="form-control"
                                    >
                                </div>
                                <div class="form-group magic-field" data-id="content" data-type="content">
                                    <label class="control-label"><?php echo e(__("Content")); ?></label>
                                    <div class="">
                                        <textarea
                                            name="content"
                                            class="d-none has-ckeditor"
                                            id="content"
                                            cols="30"
                                            rows="10"
                                        ><?php echo e($translation->content); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo $__env->make('Core::admin/seo-meta/seo-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                            <div class="panel-body">
                                <?php if(is_default_lang()): ?>
                                <div>
                                    <label><input <?php if($row->status=='publish'): ?> checked <?php endif; ?> type="radio" name="status" value="publish"> <?php echo e(__("Publish")); ?>

                                    </label></div>
                                <div>
                                    <label><input <?php if($row->status=='draft'): ?> checked <?php endif; ?> type="radio" name="status" value="draft"> <?php echo e(__("Draft")); ?>

                                    </label></div>
                                <?php endif; ?>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php echo e(__('Save Changes')); ?></button>
                                </div>
                            </div>
                        </div>
                        <?php if(is_default_lang()): ?>
                            <?php echo $__env->make('Page::admin.advanced', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="panel">
                                <div class="panel-body">
                                    <h3 class="panel-body-title"><?php echo e(__('Logo')); ?></h3>
                                    <div class="form-group">
                                        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('custom_logo',$row->custom_logo); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-body">
                                    <h3 class="panel-body-title"><?php echo e(__('Feature Image')); ?></h3>
                                    <div class="form-group">
                                        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529938690/domains/traviaana.com/public_html/modules/Page/Views/admin/detail.blade.php ENDPATH**/ ?>