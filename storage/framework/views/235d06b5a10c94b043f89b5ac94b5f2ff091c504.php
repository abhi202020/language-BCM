
<?php $__env->startSection('title', __('labels.backend.tax.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .form-control-label {
            line-height: 35px;
        }
        .remove{
            float: right;
            color: red;
            font-size: 20px;
            cursor: pointer;
        }
        .error{
            color: red;
        }

    </style>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo e(html()->form('POST', route('admin.tax.store'))->id('tax-create')->class('form-horizontal')->acceptsFiles()->open()); ?>

    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->get('labels.backend.tax.create'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.sliders.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.tax.view'); ?></a>

            </div>
        </div>
        <div class="card-body">

            <div class="row form-group">
                <?php echo e(html()->label(__('labels.backend.tax.fields.name'))->class('col-md-2 form-control-label')->for('first_name')); ?>


                <div class="col-md-10">
                    <?php echo e(html()->text('name')
                        ->class('form-control')
                        ->placeholder(__('labels.backend.tax.fields.name'))
                    ->autofocus()); ?>


                </div><!--col-->
            </div>

            <div class="row form-group">
                <?php echo e(html()->label(__('labels.backend.tax.fields.rate').' (in %)')->class('col-md-2 form-control-label')->for('first_name')); ?>


                <div class="col-md-10">
                    <?php echo e(html()->input('number','rate')
                        ->class('form-control')
                        ->placeholder(__('labels.backend.tax.fields.rate'))); ?>


                </div><!--col-->
            </div>


            <div class="form-group row justify-content-center">
                <div class="col-4">
                    <?php echo e(form_cancel(route('admin.tax.index'), __('buttons.general.cancel'))); ?>


                    <button class="btn btn-success pull-right" type="submit"><?php echo e(__('buttons.general.crud.create')); ?></button>
                </div>
            </div><!--col-->
        </div>
    </div>
    <?php echo e(html()->form()->close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\tax\create.blade.php ENDPATH**/ ?>