
<?php $__env->startSection('title', trans('labels.subscription.payment_status').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        input[type="radio"] {
            display: inline-block !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Start of breadcrumb section
        ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><?php echo app('translator')->get('labels.subscription.your_subscription_status'); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->
    <section id="checkout" class="checkout-section">
        <div class="container">
            <div class="section-title mb45 headline text-center">
                <?php if(session()->has('success')): ?>
                    <h2>  <?php echo e(session('success')); ?></h2>
                    <h4><a href="<?php echo e(url('/')); ?>"><?php echo app('translator')->get('labels.subscription.go_to_home'); ?></a></h4>
                <?php endif; ?>
                <?php if(session()->has('failure')): ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h2>  <?php echo e(session('failure')); ?></h2>
                    <h4><a href="<?php echo e(route('subscription.plans')); ?>"><?php echo app('translator')->get('labels.subscription.go_to_plan'); ?></a></h4>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\subscription\status.blade.php ENDPATH**/ ?>