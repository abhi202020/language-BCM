<form id="caseFreePaymentForm" method="post" action="<?php echo e($endPoint); ?>">
<?php $__currentLoopData = $parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <input type="hidden" name="signature" value="<?php echo e($signature); ?>">
</form>
<script>document.getElementById("caseFreePaymentForm").submit();</script>
<?php /**PATH C:\xampp\htdocs\language\resources\views\includes\cashfreeForm.blade.php ENDPATH**/ ?>