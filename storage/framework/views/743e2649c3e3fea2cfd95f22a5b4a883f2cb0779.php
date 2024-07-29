
<?php $__env->startSection('title', __('labels.backend.testimonials.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <?php echo Form::model($testimonial, ['method' => 'PUT', 'route' => ['admin.testimonials.update', $testimonial->id], 'files' => true,]); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.questions.edit'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.questions.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.questions.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('content', trans('labels.backend.testimonials.fields.name').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::text('name', old('name'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.testimonials.fields.name').'*', 'required' => '']); ?>


                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('occupation', trans('labels.backend.testimonials.fields.occupation').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::text('occupation', old('occupation'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.testimonials.fields.occupation').'*', 'required' => '']); ?>


                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('content', trans('labels.backend.testimonials.fields.content').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('content', old('content'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.testimonials.fields.content').'*', 'required' => '']); ?>


                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 text-center mb-4">
            <?php echo Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn btn-danger']); ?>


        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\testimonials\edit.blade.php ENDPATH**/ ?>