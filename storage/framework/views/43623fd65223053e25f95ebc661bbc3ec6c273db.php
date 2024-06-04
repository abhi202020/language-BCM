
<?php $__env->startSection('title', __('labels.backend.reasons.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')); ?>"/>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->get('labels.backend.reasons.create'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.reasons.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.reasons.view'); ?></a>

            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-12">

                    <?php echo Form::open(['method' => 'POST', 'route' => ['admin.reasons.store'], 'files' => true,]); ?>


                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-8 form-group">
                            <?php echo Form::label('title', trans('labels.backend.reasons.fields.title').' *', ['class' => 'control-label']); ?>

                            <?php echo Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.reasons.fields.title'), 'required' => false]); ?>


                        </div>


                        <div class="col-12 col-lg-4  form-group">

                                <?php echo Form::label('icon',  trans('labels.backend.reasons.fields.icon'), ['class' => 'control-label  d-block']); ?>

                                <button class="btn  btn-block btn-default border" id="icon" name="icon" title="icon"></button>

                        </div>
                        <div class="col-12 form-group">
                            <?php echo Form::label('content', trans('labels.backend.reasons.fields.content').' *', ['class' => 'control-label']); ?>

                            <?php echo Form::textarea('content', old('content'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.reasons.fields.content'), 'required' => false]); ?>


                        </div>

                        <div class="col-12 form-group text-center">

                            <?php echo Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn mt-auto  btn-danger']); ?>

                        </div>
                    </div>

                    <?php echo Form::close(); ?>


                </div>


            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script src="<?php echo e(asset('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js')); ?>"></script>

    <script>
        $(document).ready(function () {
            $('#icon').iconpicker({
                cols: 10,
                icon: 'fas fa-bomb',
                iconset: 'fontawesome5',
                labelHeader: '{0} of {1} pages',
                labelFooter: '{0} - {1} of {2} icons',
                placement: 'bottom', // Only in button tag
                rows: 5,
                search: true,
                searchText: 'Search',
                selectedClass: 'btn-success',
                unselectedClass: ''
            });


        })

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/backend/reasons/create.blade.php ENDPATH**/ ?>