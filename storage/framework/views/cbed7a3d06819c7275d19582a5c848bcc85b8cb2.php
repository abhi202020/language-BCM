
<?php $__env->startSection('title', __('labels.backend.live_lesson_slots.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.live_lesson_slots.title'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lessons.fields.course'); ?></th>
                            <td><?php echo e($liveLessonSlot->lesson->course->title); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lesson_slots.fields.lesson'); ?></th>
                            <td><?php echo e($liveLessonSlot->lesson->title); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lesson_slots.fields.meeting_id'); ?></th>
                            <td><?php echo e($liveLessonSlot->meeting_id); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lesson_slots.fields.topic'); ?></th>
                            <td><?php echo e($liveLessonSlot->topic); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lesson_slots.fields.short_text'); ?></th>
                            <td><?php echo $liveLessonSlot->description; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lesson_slots.fields.duration'); ?></th>
                            <td><?php echo $liveLessonSlot->duration; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lesson_slots.fields.date'); ?></th>
                            <td><?php echo $liveLessonSlot->start_at->format('Y-m-d\TH:i'); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lesson_slots.start_url'); ?></th>
                            <td>
                                <a href="<?php echo e($liveLessonSlot->start_url); ?>" target="_blank" class="btn btn-info">
                                    <?php echo app('translator')->get('labels.backend.live_lesson_slots.start_url'); ?>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

            <?php if($liveLessonSlot->lessonSlotBookings->count()): ?>
            <h4> <?php echo app('translator')->get('labels.backend.live_lesson_slots.slot_booked_student_list'); ?></h4>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.live_lesson_slots.student_name'); ?></th>
                            <th><?php echo app('translator')->get('labels.backend.live_lesson_slots.student_email'); ?></th>
                        </tr>
                        <?php $__empty_1 = true; $__currentLoopData = $liveLessonSlot->lessonSlotBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($booking->user->name); ?></td>
                            <td><?php echo e($booking->user->email); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <a href="<?php echo e(route('admin.live-lesson-slots.index')); ?>"
               class="btn btn-default border"><?php echo app('translator')->get('strings.backend.general.app_back_to_list'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\live-lesson-slots\show.blade.php ENDPATH**/ ?>