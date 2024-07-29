
<?php $__env->startSection('title', __('labels.backend.payments.add_withdrawal_request').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>
<?php echo Form::open(['method' => 'POST', 'route' => ['admin.payments.withdraw_store']]); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->get('labels.backend.payments.add_withdrawal_request'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 form-group">
                <?php echo Form::label('payment_type',trans('labels.backend.payments.fields.payment_type'), ['class' => 'control-label']); ?>

                <?php echo Form::select('payment_type', $payment_types, old('payment_type'), ['class' => 'form-control select2 js-example-placeholder-multiple']); ?>

                </div>
                <div class="col-6 form-group">
                <?php echo Form::label('amount',trans('labels.backend.payments.fields.amount'), ['class' => 'control-label']); ?>

                <?php echo Form::number('amount', old('amount'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.payments.fields.amount'), 'pattern' => "[0-9]", 'min' => '1', 'max' => $total_balance, 'step' => '.01']); ?>

                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="col-4">
                    <?php echo e(form_cancel(route('admin.payments'), __('buttons.general.cancel'))); ?>

                    <?php echo e(form_submit(__('buttons.general.crud.create'))); ?>

                </div>
            </div><!--col-->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\payments\withdraw_request_form.blade.php ENDPATH**/ ?>