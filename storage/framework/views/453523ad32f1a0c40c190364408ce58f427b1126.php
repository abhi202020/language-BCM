
<?php if($item->subs): ?>

<li class="card ">
    <div class="card-header" id="heading<?php echo e($item->id); ?>">
        <button class="menu-link" data-toggle="collapse" data-target="#collapse<?php echo e($item->id); ?>"
                aria-expanded="false" aria-controls="collapse<?php echo e($item->id); ?>">
            <?php echo e(trans('custom-menu.'.$menu_name.'.'.str_slug($item->label))); ?>

        </button>
    </div>
    <ul id="collapse<?php echo e($item->id); ?>" class="submenu collapse " aria-labelledby="heading<?php echo e($item->id); ?>"
        data-parent="#accordion" style="">
        <?php $__currentLoopData = $item->subs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('frontend.layouts.partials.dropdown2', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</li>
<?php else: ?>
    <li class="card">
        <a class="menu-link" id="menu-<?php echo e($item->id); ?>" href="<?php echo e($item->link); ?>"><?php echo e(trans('custom-menu.'.$menu_name.'.'.str_slug($item->label))); ?></a>
    </li>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\layouts\partials\dropdown2.blade.php ENDPATH**/ ?>