

<?php $__env->startSection('title', app_name() . ' | ' . __('labels.frontend.passwords.expired_password_box_title')); ?>

<?php $__env->startSection('content'); ?>
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><?php echo e(__('labels.frontend.passwords.expired_password_box_title')); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section id="about-page" class="about-page-section pb-0">

    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 align-self-center">
            <div class="card border-0">
                <div class="card-body">
                    <?php echo e(html()->form('PATCH', route('frontend.auth.password.expired.update'))->class('form-horizontal')->open()); ?>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?php echo e(html()->label(__('validation.attributes.frontend.old_password'))->for('old_password')); ?>


                                    <?php echo e(html()->password('old_password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.old_password'))
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

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                   <button class="btn btn-info" type="submit"><?php echo e(__('labels.frontend.passwords.update_password_button')); ?></button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                    <?php echo e(html()->form()->close()); ?>

                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-6 -->
    </div><!-- row -->
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\auth\passwords\expired.blade.php ENDPATH**/ ?>