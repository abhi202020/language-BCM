<?php $__env->startComponent('mail::message'); ?>
    <h4>Hello Admin, Following contact has messaged you from Contact Page of <a style="font-weight:bold;" href="<?php echo e(env('APP_URL')); ?>"><?php echo e(env('APP_NAME')); ?></a></h4>
    Name: <?php echo e($contactMessage->name); ?>

    Email: <?php echo e($contactMessage->emails); ?>

    Number: <?php echo e($contactMessage->number); ?>

    Message: <?php echo e($contactMessage->message); ?>


    Thanks,
    <?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\language\resources\views\emails\contact_mail.blade.php ENDPATH**/ ?>