<?php $__env->startComponent('mail::message'); ?>
Hello **<?php echo e($content['name']); ?>**

Your meeting details are below.

Course **<?php echo e($content['course']); ?>** <br>
Lesson **<?php echo e($content['lesson']); ?>** <br>
Zoom Meeting ID **<?php echo e($content['meeting_id']); ?>** <br>
Password **<?php echo e($content['password']); ?>** <br>
Date **<?php echo e($content['start_at']->format('Y-m-d\TH:i')); ?> (<?php echo e(config('zoom.timezone')); ?>)** <br>


<?php $__env->startComponent('mail::button', ['url' => $content['start_url']]); ?>
    Start URL
<?php echo $__env->renderComponent(); ?>

[<?php echo e($content['start_url']); ?>](<?php echo e($content['start_url']); ?>).


Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\language\resources\views\emails\teacherMeetingSlotMail.blade.php ENDPATH**/ ?>