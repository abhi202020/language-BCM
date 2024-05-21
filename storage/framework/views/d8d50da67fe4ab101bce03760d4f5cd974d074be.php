Hello <?php echo e(auth()->user()->name); ?>, <br><br>

Thank you for placing an order with Margie’s Magical Verbs. Your order is now being processed, and we will ensure you can access your Spanish lesson shortly.<br><br>

We are pleased to confirm the receipt of your order # <?php echo e($order->id ?? 'N/A'); ?>, dated <?php echo e($formattedDate ?? 'N/A'); ?><br><br>

Thank you for choosing Margie’s Magical Verbs. We value your business and look forward to seeing you on the inside.<br><br>

Please find the attached invoice below.<br><br>

Hasta pronto,<br><br><br>
Margie’s Magical Verbs<br><br>

<?php $__env->startComponent('mail::button', ['url' => config('app.url')]); ?>
    Visit Our Website
<?php echo $__env->renderComponent(); ?><br><br>
<?php /**PATH C:\xampp\htdocs\language\resources\views/emails/userOrderConfirmation.blade.php ENDPATH**/ ?>