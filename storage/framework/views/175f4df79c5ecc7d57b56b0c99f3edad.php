

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('user.admin.store',['id'=>$row->id ?? -1])); ?>" method="post" class="needs-validation" novalidate>
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? 'Edit: '.$row->getDisplayName() : 'Add new user'); ?></h1>
                </div>
            </div>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('User Info')); ?></strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Business name")); ?></label>
                                        <input type="text" value="<?php echo e(old('business_name',$row->business_name)); ?>" required name="business_name" placeholder="<?php echo e(__("Business name")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('E-mail')); ?></label>
                                        <input type="email" required value="<?php echo e(old('email',$row->email)); ?>" placeholder="<?php echo e(__('Email')); ?>" name="email" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("User name")); ?></label>
                                        <input type="text" name="user_name" required value="<?php echo e(old('user_name',$row->user_name)); ?>" placeholder="<?php echo e(__("User name")); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("First name")); ?></label>
                                        <input type="text" required value="<?php echo e(old('first_name',$row->first_name)); ?>" name="first_name" placeholder="<?php echo e(__("First name")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Last name")); ?></label>
                                        <input type="text" required value="<?php echo e(old('last_name',$row->last_name)); ?>" name="last_name" placeholder="<?php echo e(__("Last name")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Phone Number')); ?></label>
                                        <input type="text" value="<?php echo e(old('phone',$row->phone)); ?>" placeholder="<?php echo e(__('Phone')); ?>" name="phone" class="form-control" required   >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Birthday')); ?></label>
                                        <input type="text" value="<?php echo e(old('birthday',$row->birthday ? date("Y/m/d",strtotime($row->birthday)) :'')); ?>" placeholder="<?php echo e(__('Birthday')); ?>" name="birthday" class="form-control has-datepicker input-group date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Address Line 1')); ?></label>
                                        <input type="text" value="<?php echo e(old('address',$row->address)); ?>" placeholder="<?php echo e(__('Address')); ?>" name="address" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Address Line 2')); ?></label>
                                        <input type="text" value="<?php echo e(old('address2',$row->address2)); ?>" placeholder="<?php echo e(__('Address 2')); ?>" name="address2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("City")); ?></label>
                                        <input type="text" value="<?php echo e(old('city',$row->city)); ?>" name="city" placeholder="<?php echo e(__("City")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("State")); ?></label>
                                        <input type="text" value="<?php echo e(old('state',$row->state)); ?>" name="state" placeholder="<?php echo e(__("State")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=""><?php echo e(__("Country")); ?></label>
                                        <select name="country" class="form-control" id="country-sms-testing" required>
                                            <option value=""><?php echo e(__('-- Select --')); ?></option>
                                            <?php $__currentLoopData = get_country_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($row->country==$id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Zip Code")); ?></label>
                                        <input type="text" value="<?php echo e(old('zip_code',$row->zip_code)); ?>" name="zip_code" placeholder="<?php echo e(__("Zip Code")); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo e(__('Biographical')); ?></label>
                                <div class="">
                                    <textarea name="bio" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e(old('bio',$row->bio)); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label><?php echo e(__('Status')); ?></label>
                                <select required class="custom-select" name="status">
                                    <option <?php if(old('status',$row->status) =='publish'): ?> selected <?php endif; ?> value="publish"><?php echo e(__('Publish')); ?></option>
                                    <option <?php if(old('status',$row->status) =='blocked'): ?> selected <?php endif; ?> value="blocked"><?php echo e(__('Blocked')); ?></option>
                                </select>
                            </div>
                            <?php if(is_admin()): ?>
                                <?php if(empty($user_type) or $user_type != 'vendor'): ?>
                                    <div class="form-group">
                                        <label><?php echo e(__('Role')); ?> <span class="text-danger">*</span></label>
                                        <select required class="form-control" name="role_id">
                                            <option value=""><?php echo e(__('-- Select --')); ?></option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($role->id); ?>" <?php if(old('role_id',$row->role_id) == $role->id): ?> selected <?php elseif(old('role_id')  == $role->id ): ?> selected <?php elseif(request()->input("user_type")  == strtolower($role->name) ): ?> selected <?php endif; ?> ><?php echo e(ucfirst($role->name)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label><?php echo e(__('Email Verified?')); ?></label>
                                    <select  class="form-control" name="is_email_verified">
                                        <option value=""><?php echo e(__('No')); ?></option>
                                        <option <?php if(old('is_email_verified',$row->email_verified_at ? 1 : 0)): ?> selected <?php endif; ?> value="1"><?php echo e(__('Yes')); ?></option>
                                    </select>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Vendor')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label><?php echo e(__('Vendor Commission Type')); ?></label>
                                <div class="form-controls">
                                    <select name="vendor_commission_type" class="form-control">
                                        <option value=""><?php echo e(__("Default")); ?></option>
                                        <option value="percent" <?php echo e(old("vendor_commission_type",($row->vendor_commission_type ?? '')) == 'percent' ? 'selected' : ''); ?>><?php echo e(__('Percent')); ?></option>
                                        <option value="amount" <?php echo e(old("vendor_commission_type",($row->vendor_commission_type ?? '')) == 'amount' ? 'selected' : ''); ?>><?php echo e(__('Amount')); ?></option>
                                        <option value="disable" <?php echo e(old("vendor_commission_type",($row->vendor_commission_type ?? '')) == 'disable' ? 'selected' : ''); ?>><?php echo e(__('Disable Commission')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Vendor commission value')); ?></label>
                                <div class="form-controls">
                                    <input type="text" class="form-control" name="vendor_commission_amount" value="<?php echo e(old("vendor_commission_amount",($row->vendor_commission_amount ?? ''))); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Avatar')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('avatar_id',old('avatar_id',$row->avatar_id)); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span></span>
                <button class="btn btn-primary" type="submit"><?php echo e(__('Save Change')); ?></button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529938690/domains/traviaana.com/public_html/modules/User/Views/admin/detail.blade.php ENDPATH**/ ?>