

<?php $__env->startSection('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title')); ?>

<?php $__env->startSection('content'); ?>
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold"><?php echo e(__('labels.frontend.passwords.reset_password_box_title')); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section id="about-page" class="about-page-section pb-0">
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-6 align-self-center">
                <div class="card border-0">
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="list-inline list-style-none">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php echo e(html()->form('POST', route('frontend.auth.password.reset'))->class('form-horizontal')->open()); ?>

                        <?php echo e(html()->hidden('token', $token)); ?>


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

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    <button class="btn btn-info" type="submit"><?php echo e(__('labels.frontend.passwords.reset_password_button')); ?></button>
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

<?php echo $__env->make('frontend'.(session()->get('display_type') == "rtl"?"-rtl":"").'.layouts.app'.config('theme_layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\frontend\auth\passwords\reset.blade.php ENDPATH**/ ?>