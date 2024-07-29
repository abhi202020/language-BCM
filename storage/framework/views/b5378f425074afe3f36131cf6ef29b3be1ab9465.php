<?php $__env->startComponent('mail::message'); ?>
# Hello Admin

In our system new user registered, User details are below

Name **<?php echo e($user->name); ?>** <br>
Email **<?php echo e($user->email); ?>**


Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\language\resources\views\emails\adminRegisteredMail.blade.php ENDPATH**/ ?>