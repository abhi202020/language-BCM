

<?php $__env->startSection('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title')); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <?php echo app('translator')->get('labels.frontend.auth.register_box_title'); ?>
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <?php echo e(html()->form('POST', route('frontend.auth.register.post'))->open()); ?>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php echo e(html()->label(__('validation.attributes.frontend.first_name'))->for('first_name')); ?>


                                    <?php echo e(html()->text('first_name')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.first_name'))
                                        ->attribute('maxlength', 191)); ?>

                                </div><!--col-->
                            </div><!--row-->

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <?php echo e(html()->label(__('validation.attributes.frontend.last_name'))->for('last_name')); ?>


                                    <?php echo e(html()->text('last_name')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.last_name'))
                                        ->attribute('maxlength', 191)); ?>

                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?php echo e(html()->label(__('validation.attributes.frontend.email'))->for('email')); ?>


                                    <?php echo e(html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required()); ?>

                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?php echo e(html()->label(__('validation.attributes.frontend.password'))->for('password')); ?>


                                    <?php echo e(html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required()); ?>

                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?php echo e(html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation')); ?>


                                    <?php echo e(html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required()); ?>

                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <?php if(config('access.captcha.registration')): ?>
                            <div class="row">
                                <div class="col">
                                    <?php echo Captcha::display(); ?>

                                    <?php echo e(html()->hidden('captcha_status', 'true')); ?>

                                </div><!--col-->
                            </div><!--row-->
                        <?php endif; ?>

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    <?php echo e(form_submit(__('labels.frontend.auth.register_button'))); ?>

                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    <?php echo e(html()->form()->close()); ?>


                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <?php echo $socialiteLinks; ?>

                            </div>
                        </div><!--/ .col -->
                    </div><!-- / .row -->

                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-md-8 -->
    </div><!-- row -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <?php if(config('access.captcha.registration')): ?>
        <?php echo Captcha::script(); ?>

    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\auth\register.blade.php ENDPATH**/ ?>