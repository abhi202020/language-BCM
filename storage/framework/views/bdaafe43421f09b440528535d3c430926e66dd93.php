

<?php $__env->startSection('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.change_password')); ?>

<?php $__env->startSection('breadcrumb-links'); ?>
    <?php echo $__env->make('backend.auth.user.includes.breadcrumb-links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo e(html()->form('PATCH', route('admin.auth.user.change-password.post', $user))->class('form-horizontal')->open()); ?>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        <?php echo app('translator')->get('labels.backend.access.users.management'); ?>
                        <small class="text-muted"><?php echo app('translator')->get('labels.backend.access.users.change_password'); ?></small>
                    </h4>

                    <div class="small text-muted">
                        <?php echo app('translator')->get('labels.backend.access.users.change_password_for', ['user' => $user->name]); ?>
                    </div>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <?php echo e(html()->label(__('validation.attributes.backend.access.users.password'))->class('col-md-2 form-control-label')->for('password')); ?>


                        <div class="col-md-10">
                            <?php echo e(html()->password('password')
                                ->class('form-control')
                                ->placeholder( __('validation.attributes.backend.access.users.password'))
                                ->required()
                                ->autofocus()); ?>

                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <?php echo e(html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation')); ?>


                        <div class="col-md-10">
                            <?php echo e(html()->password('password_confirmation')
                                ->class('form-control')
                                ->placeholder( __('validation.attributes.backend.access.users.password_confirmation'))
                                ->required()); ?>

                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <?php echo e(form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel'))); ?>

                </div><!--col-->

                <div class="col text-right">
                    <?php echo e(form_submit(__('buttons.general.crud.update'))); ?>

                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
<?php echo e(html()->form()->close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\auth\user\change-password.blade.php ENDPATH**/ ?>