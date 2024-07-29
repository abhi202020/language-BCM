<?php $__env->startComponent('mail::message'); ?>
Hello **<?php echo e(auth()->user()->name); ?>**

You have successfully booked your live lesson **<?php echo e($content->lesson->title); ?>** slot

Zoom Meeting ID **<?php echo e($content->meeting_id); ?>** <br>
Password **<?php echo e($content->password); ?>** <br>
Date **<?php echo e($content->start_at->format('Y-m-d\TH:i')); ?> (<?php echo e(config('zoom.timezone')); ?>)** <br>


<?php $__env->startComponent('mail::button', ['url' => 'https://us04web.zoom.us/j/'.$content->meeting_id]); ?>
Join URL
<?php echo $__env->renderComponent(); ?>

[https://us04web.zoom.us/j/<?php echo e($content->meeting_id); ?>](https://us04web.zoom.us/j/<?php echo e($content->meeting_id); ?>).


Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\language\resources\views\emails\studentMeetingSlotMail.blade.php ENDPATH**/ ?>