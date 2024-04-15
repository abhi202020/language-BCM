

<?php $__env->startPush('after-styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/amigo-sorter/css/theme-default.css')); ?>">
    <style>
        /* Add your custom styles here */
        .card {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #cccccc;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title', __('labels.backend.live_lesson_slots.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->get('labels.backend.live_lesson_slots.title'); ?></h3>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_slot_create')): ?>
                <div class="float-right">
                    <a href="<?php echo e(route('admin.live-lesson-slots.create')); ?><?php if(request('lesson_id')): ?><?php echo e('?lesson_id='.request('lesson_id')); ?><?php endif; ?>"
                       class="btn btn-success"><?php echo app('translator')->get('strings.backend.general.app_add_new'); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Start At</th>
                            <th>Course</th>
                            <th>Topic</th>
                            <th>Duration</th>
                            <th>Meeting ID</th>
                            <th>Password</th>
                            <th>Students</th>
                            <th>Start URL</th>
                            <th><?php echo app('translator')->get('strings.backend.general.actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $liveLessonSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $liveLessonSlot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($liveLessonSlot->start_at); ?></td>
                                <td><?php echo e($liveLessonSlot->lesson->course->title ?? ''); ?></td>
                                <td><?php echo e($liveLessonSlot->topic); ?></td>
                                <td><?php echo e($liveLessonSlot->duration); ?></td>
                                <td><?php echo e($liveLessonSlot->meeting_id); ?></td>
                                <td><?php echo e($liveLessonSlot->password); ?></td>
                                <td><?php echo e($liveLessonSlot->lessonSlotBookings->count()); ?></td>
                                <td>
                                    <a href="<?php echo e($liveLessonSlot->start_url); ?>" class="btn btn-primary" target="_blank">Join Lesson</a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <!-- Adjust the permissions check as needed for Show -->
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_slot_show')): ?>
                                            <a href="<?php echo e(route('admin.live-lesson-slots.show', $liveLessonSlot)); ?>" class="btn btn-info">
                                                Show
                                            </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_slot_edit')): ?>
                                            <a href="<?php echo e(route('admin.live-lesson-slots.edit', $liveLessonSlot)); ?>" class="btn btn-primary">
                                                Edit
                                            </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_slot_delete')): ?>
                                            <form action="<?php echo e(route('admin.live-lesson-slots.destroy', $liveLessonSlot)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('<?php echo app('translator')->get('strings.backend.general.are_you_sure'); ?>')">
                                                    Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9">No live lessons available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/uat.margiesmagicalverbs.com/public_html/resources/views/backend/live-lesson-slots/index.blade.php ENDPATH**/ ?>