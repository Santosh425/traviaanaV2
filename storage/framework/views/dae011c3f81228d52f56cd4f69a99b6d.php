<div class="form-group">
	<label><?php echo e(__("Import url")); ?></label>
	<input type="text" value="<?php echo e($row->ical_import_url); ?>" name="ical_import_url" class="form-control">
</div>
<?php if(!empty($row->id)): ?>
	<div class="form-group">
		<label><?php echo e(__("Export url")); ?></label>
		<input type="text" value="<?php echo e(route('booking.admin.export-ical',['type'=>'room',$row->id])); ?>" class="form-control">
	</div>
<?php endif; ?>
<?php /**PATH /home/u529938690/domains/traviaana.com/public_html/modules/Hotel/Views/admin/room/form-detail/ical.blade.php ENDPATH**/ ?>