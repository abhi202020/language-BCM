<?php $__env->startComponent('mail::message'); ?>
# Hello, <?php echo e($admin->name); ?>


Notified new order on system are below:<br>

## Buyer Details <br>
Name: <?php echo e(auth()->user()->name); ?> <br>
Email: <?php echo e(auth()->user()->email); ?> <br>

### Order Details <br>
Order Reference No. <?php echo e($content['reference_no']); ?> <br>
<?php $__currentLoopData = $content['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    **<?php echo e($item['number']); ?>. <?php echo e($item['name']); ?> <?php echo e($appCurrency['symbol'].$item['price']); ?>**<br>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

### Total Amount : <?php echo e($appCurrency['symbol']); ?> <?php echo e($content['total']); ?>



Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>

<?php /**PATH C:\xampp\htdocs\language\resources\views\emails\adminOrderMail.blade.php ENDPATH**/ ?>