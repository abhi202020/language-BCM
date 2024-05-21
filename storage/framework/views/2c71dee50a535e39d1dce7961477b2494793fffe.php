
<?php $__env->startSection('title', __('labels.backend.forum_category.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .form-control-label {
            line-height: 35px;
        }

        .remove {
            float: right;
            color: red;
            font-size: 20px;
            cursor: pointer;
        }

        .error {
            color: red;
        }

    </style>
    <!-- This Page CSS -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('plugins/@claviska/jquery-minicolors/jquery.minicolors.css')); ?>">

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo e(html()->modelForm($forum_category, 'PUT', route('admin.forums-category.update', ['forums_category' => $forum_category->id]))->class('form-horizontal')->acceptsFiles()->id('slider-create')->open()); ?>

    <div class="alert alert-danger d-none" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="error-list">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->get('labels.backend.forum_category.edit'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.forums-category.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.forum_category.view'); ?></a>
            </div>
        </div>
        <div class="card-body">

            <div class="row form-group">
                <?php echo e(html()->label(__('labels.backend.forum_category.fields.category'))->class('col-md-2 form-control-label')->for('first_name')); ?>


                <div class="col-md-10">
                    <?php echo e(html()->text('name')
                        ->class('form-control')
                        ->placeholder(__('labels.backend.forum_category.fields.category'))
                    ->required()); ?>


                </div><!--col-->
            </div>

            <div class="row form-group">
                <?php echo e(html()->label(__('labels.backend.forum_category.fields.parent_category'))->class('col-md-2 form-control-label')->for('first_name')); ?>


                <div class="col-md-10">
                    <?php echo e(html()->select('parent_id',$forum_categories)
                    ->id('parent_id')
                       ->class('form-control js-example-placeholder-single select2')); ?>

                </div>
            </div>

            <div class="row form-group">
                <?php echo e(html()->label(__('labels.backend.forum_category.fields.color'))->class('col-md-2 form-control-label')->for('color')); ?>


                <div class="col-md-10">
                    <?php echo e(html()->text('color')
                        ->class('form-control demo')
                        ->value('#0088cc')
                        ->attributes(['data-control'=>"brightness"])
                       ->required()); ?>


                </div><!--col-->
            </div>

            <div class="row form-group">
                <?php echo e(html()->label(__('labels.backend.forum_category.fields.order'))->class('col-md-2 form-control-label')->for('color')); ?>


                <div class="col-md-10">
                    <?php echo e(html()->input('number','order')
                        ->class('form-control')
                  ->placeholder('Ex. 1')); ?>


                </div><!--col-->
            </div>


            <div class="form-group row justify-content-center">
                <div class="col-4">
                    <?php echo e(form_cancel(route('admin.forums-category.index'), __('buttons.general.cancel'))); ?>


                    <button class="btn btn-success pull-right"
                            type="submit"><?php echo e(__('buttons.general.crud.update')); ?></button>
                </div>
            </div><!--col-->
        </div>

    </div>
    <?php echo e(html()->form()->close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script src="<?php echo e(asset('plugins/@claviska/jquery-minicolors/jquery.minicolors.min.js')); ?>"></script>
    <script>
        $('.demo').each(function () {
            //
            // Dear reader, it's actually very easy to initialize MiniColors. For example:
            //
            //  $(selector).minicolors();
            //
            // The way I've done it below is just for the demo, so don't get confused
            // by it. Also, data- attributes aren't supported at this time...they're
            // only used for this demo.
            //
            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                format: $(this).attr('data-format') || 'hex',
                keywords: $(this).attr('data-keywords') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom left',
                swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
                change: function (value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/backend/forum-categories/edit.blade.php ENDPATH**/ ?>