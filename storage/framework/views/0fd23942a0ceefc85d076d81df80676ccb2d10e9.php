
<?php $__env->startSection('title', __('labels.backend.live_lessons.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.live_lessons.title'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lessons.fields.course'); ?></th>
                            <td><?php echo e($liveLesson->course->title); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lessons.fields.title'); ?></th>
                            <td><?php echo e($liveLesson->title); ?></td>
                        </tr>

                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lessons.fields.short_text'); ?></th>
                            <td><?php echo $liveLesson->short_text; ?></td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->



            <a href="<?php echo e(route('admin.live-lessons.index')); ?>"
               class="btn btn-default border"><?php echo app('translator')->get('strings.backend.general.app_back_to_list'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/backend/live-lessons/show.blade.php ENDPATH**/ ?>