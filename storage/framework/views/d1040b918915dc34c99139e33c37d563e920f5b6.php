

<?php $__env->startSection('title', __('labels.backend.live_lesson_slots.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <?php echo Form::open(['method' => 'POST', 'route' => ['admin.live-lesson-slots.store'], 'files' => true,]); ?>

    <?php echo Form::hidden('model_id',0,['id'=>'lesson_id']); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.live_lesson_slots.create'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.live-lesson-slots.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.live_lesson_slots.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <?php echo $__env->make('backend.live-lesson-slots.form',['liveLessonSlot' => optional()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-12  text-center form-group">
                    <?php echo Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn  btn-danger']); ?>

                </div>
            </div>
        </div>
    </div>

    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/backend/live-lesson-slots/create.blade.php ENDPATH**/ ?>