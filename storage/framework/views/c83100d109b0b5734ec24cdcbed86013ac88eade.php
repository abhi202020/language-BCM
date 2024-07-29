<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($gateKey.'view')): ?>
    <a href="<?php echo e(route($routeKey.'.show', $row->id)); ?>"
       class="btn btn-xs btn-primary"><?php echo app('translator')->get('global.app_view'); ?></a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($gateKey.'edit')): ?>
    <a href="<?php echo e(route($routeKey.'.edit', $row->id)); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->get('global.app_edit'); ?></a>
<?php endif; ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($gateKey.'delete')): ?>
    <?php echo Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
        'route' => [$routeKey.'.destroy', $row->id])); ?>

    <?php echo Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')); ?>

    <?php echo Form::close(); ?>

<?php endif; ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\courses\actionsTemplate.blade.php ENDPATH**/ ?>