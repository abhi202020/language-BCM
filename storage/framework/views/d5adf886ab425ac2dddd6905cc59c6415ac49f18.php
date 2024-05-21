
<?php $__env->startSection('title', __('labels.backend.live_lesson_slots.edit').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::model($liveLessonSlot, ['method' => 'PUT', 'route' => ['admin.live-lesson-slots.update', ['live_lesson_slot' => $liveLessonSlot]], 'files' => true,]); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.live_lesson_slots.edit'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.live-lesson-slots.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.live_lesson_slots.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <?php echo $__env->make('backend.live-lesson-slots.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-12  text-center form-group">
                    <?php echo Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn  btn-danger']); ?>

                </div>
            </div>
        </div>
    </div>

    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/backend/live-lesson-slots/edit.blade.php ENDPATH**/ ?>