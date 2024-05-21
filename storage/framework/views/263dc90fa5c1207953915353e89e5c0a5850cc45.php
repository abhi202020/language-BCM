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

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->get('labels.backend.zoom.title'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <?php if(isset($bookedLessons) && !$bookedLessons->isEmpty()): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Course</th>
                                        <th>Lesson</th> 
                                        <th>Meeting ID</th>
                                        <th>Password</th>
                                        <th>Duration</th>
                                        <th>Start URL</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $bookedLessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lessonBooking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            $liveLessonSlot = $lessonBooking->liveLessonSlot;
                                            $courseTitle = $liveLessonSlot->lesson->course->title ?? '';
                                        ?>
                                        <tr>
                                            <td><?php echo e($liveLessonSlot->start_at); ?></td>
                                            <td><?php echo e($courseTitle); ?></td>
                                            <td><?php echo e($liveLessonSlot->lesson->id); ?></td> 
                                            <td><?php echo e($liveLessonSlot->meeting_id); ?></td>
                                            <td><?php echo e($liveLessonSlot->password); ?></td>
                                            <td><?php echo e($liveLessonSlot->duration); ?></td>
                                            <td>
                                                <a href="<?php echo e($liveLessonSlot->start_url); ?>" class="btn btn-primary" target="_blank">Join Lesson</a>
                                            </td>
                                            <td>
                                                <!-- Add your cancellation logic here if needed -->
                                                <form action="<?php echo e(route('admin.zoom.cancelLesson', $liveLessonSlot->meeting_id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this lesson?')">Cancel Lesson</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="8">No live lessons available.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No live lessons available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/backend/live-lesson-slots/student.blade.php ENDPATH**/ ?>