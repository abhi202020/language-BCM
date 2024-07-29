<a data-method="restore" data-trans-button-cancel="Cancel"
   data-trans-button-confirm="Restore" data-trans-title="Are you sure?"
   class="btn btn-xs mb-1 btn-success text-white" style="cursor:pointer;"
   onclick="$(this).find('form').submit();">
    <?php echo e(trans('strings.backend.general.app_restore')); ?>

    <form action="<?php echo e(route($route_label.'.restore',[$label=> $value])); ?>"
          method="POST" name="restore_item" style="display:none">
        <?php echo csrf_field(); ?>
    </form>
</a>
<?php /**PATH C:\xampp\htdocs\language\resources\views\backend\datatable\action-restore.blade.php ENDPATH**/ ?>