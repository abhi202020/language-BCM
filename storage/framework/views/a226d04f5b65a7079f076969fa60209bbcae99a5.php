<?php if($item->subs): ?>
    <li>
        <a class="" id="menu-<?php echo e($item->id); ?>" href="<?php echo e($item->link); ?>"><?php echo e(trans('custom-menu.'.$menu_name.'.'.str_slug($item->label))); ?></a>
        <ul class="depth-<?php echo e($item->depth); ?>">
            <?php $__currentLoopData = $item->subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('frontend.layouts.partials.dropdown', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </li>
<?php else: ?>
    <li>
        <a class="" id="menu-<?php echo e($item->id); ?>" href="<?php echo e($item->link); ?>"><?php echo e(trans('custom-menu.'.$menu_name.'.'.str_slug($item->label))); ?></a>
    </li>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\layouts\partials\dropdown.blade.php ENDPATH**/ ?>