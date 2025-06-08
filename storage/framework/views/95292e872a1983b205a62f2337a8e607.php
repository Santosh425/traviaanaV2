<div class="form-group">
    <label><?php echo e(__("Page become an expert")); ?></label>
    <div class="form-controls">
        <?php
        $template = !empty($page = setting_item("vendor_page_become_an_expert")) ? \Modules\Page\Models\Page::find($page ) : false;
        \App\Helpers\AdminForm::select2('vendor_page_become_an_expert',[
            'configs'=>[
                'ajax'=>[
                    'url'=>route('page.admin.getForSelect2'),
                    'dataType'=>'json'
                ]
            ]
        ],
            !empty($template->id) ? [$template->id,$template->title] :false
        )
        ?>
    </div>
</div>
<?php /**PATH /home/u529938690/domains/traviaana.com/public_html/themes/GoTrip/Vendor/Views/admin/setting-after-general.blade.php ENDPATH**/ ?>