<div class="row">
    <div class="col-12 col-lg-12 form-group">
        <?php echo Form::label('topic', trans('labels.backend.stripe.plan.fields.name').'*', ['class' => 'control-label']); ?>

        <?php echo Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.stripe.plan.fields.name'), 'required' => true]); ?>

    </div>
    <div class="col-12 col-lg-6 form-group">
        <?php echo Form::label('courses_selected',trans('labels.backend.stripe.plan.fields.select_course'), ['class' => 'control-label']); ?>

        <?php echo Form::select('courses_selected[]', $courses, old('courses_selected')?old('courses_selected'):$courseArr, ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple']); ?>

    </div>
    <div class="col-12 col-lg-6 form-group">
        <?php echo Form::label('bundle_selected',trans('labels.backend.stripe.plan.fields.select_bundles'), ['class' => 'control-label']); ?>

        <?php echo Form::select('bundle_selected[]', $bundles, old('bundle_selected')?old('bundle_selected'):$bundleArr, ['class' => 'form-control select2 js-example-placeholder-multiple', 'multiple' => 'multiple']); ?>

    </div>
    <div class="col-12 col-lg-6 form-group">
        <?php echo Form::label('course', trans('labels.backend.stripe.plan.fields.course'), ['class' => 'control-label']); ?>

        <?php echo Form::number('course', old('course'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.stripe.plan.fields.course'), 'required' => true, 'readonly' => $plan->id? true: false]); ?>

        <small class="form-text text-muted"><?php echo app('translator')->get('labels.backend.stripe.plan.input_quantity_note'); ?></small>

    </div>
    <div class="col-12 col-lg-6 form-group">
        <?php echo Form::label('bundle', trans('labels.backend.stripe.plan.fields.bundle'), ['class' => 'control-label']); ?>

        <?php echo Form::number('bundle', old('bundle'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.stripe.plan.fields.bundle'), 'required' => true, 'readonly' => $plan->id? true: false]); ?>

        <small class="form-text text-muted"><?php echo app('translator')->get('labels.backend.stripe.plan.input_quantity_note'); ?></small>
    </div>

</div>
<div class="row">
    <div class="col-12 col-lg-6 form-group">
        <?php echo Form::label('amount', trans('labels.backend.stripe.plan.fields.amount').'*', ['class' => 'control-label']); ?>

        <?php echo Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.stripe.plan.fields.amount'), 'required' => true, 'min' => 10, 'readonly' => $plan->id? true: false]); ?>

    </div>

    <div class="col-12 col-lg-6 form-group">
        <?php echo Form::label('currency', trans('labels.backend.stripe.plan.fields.currency').'*', ['class' => 'control-label']); ?>

        <?php echo Form::text('currency', old('currency'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.stripe.plan.fields.currency'), 'required' => true, 'readonly' => $plan->id? true: false]); ?>

        <small class="help-text font-italic"><?php echo app('translator')->get('labels.backend.stripe.plan.stripe_currency_note'); ?></small>
    </div>
</div>
<div class="row">
    <div class="col-12 col-lg-6 form-group">
        <?php echo Form::label('Expire', trans('labels.backend.stripe.plan.fields.expire'), ['class' => 'control-label']); ?>

        <?php echo Form::number('expire', old('expire'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.stripe.plan.fields.expire'), 'readonly' => $plan->id? true: false]); ?>

        <small class="help-text font-italic"><strong><?php echo app('translator')->get('labels.backend.stripe.plan.stripe_expire_note'); ?></strong></small>
    </div>
    <div class="col-12 col-lg-6 form-group">
        <?php echo Form::label('interval', trans('labels.backend.stripe.plan.fields.interval').'*', ['class' => 'control-label']); ?>

        <?php echo Form::select('interval',trans('labels.backend.stripe.plan.interval_type'), old('interval'), ['class' => 'form-control','required' => true, 'readonly' => $plan->id? true: false]); ?>

    </div>
</div>
<div class="row">
    <div class="col-12 form-group">
        <?php echo Form::label('description', trans('labels.backend.stripe.plan.fields.description'), ['class' => 'control-label']); ?>

        <?php echo Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => trans('labels.backend.stripe.plan.fields.description')]); ?>

    </div>
</div>

<?php /**PATH C:\xampp\htdocs\language\resources\views\backend\stripe\plan\form.blade.php ENDPATH**/ ?>