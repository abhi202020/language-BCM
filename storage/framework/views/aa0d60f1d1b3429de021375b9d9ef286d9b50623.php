
<?php $__env->startSection('title', __('labels.backend.stripe.plan.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.stripe.plan.title'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.stripe.plan.fields.name'); ?></th>
                            <td><?php echo e($plan->name); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.stripe.plan.fields.interval'); ?></th>
                            <td class="text-capitalize"><?php echo e($plan->interval); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.stripe.plan.fields.currency'); ?></th>
                            <td><?php echo e($plan->currency); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.stripe.plan.fields.amount'); ?></th>
                            <td><?php echo e($plan->amount); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.stripe.plan.fields.course'); ?></th>
                            <td><?php echo e(trans_choice('labels.backend.stripe.plan.course', $plan->course, ['quantity' => $plan->course])); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.stripe.plan.fields.bundle'); ?></th>
                            <td><?php echo e(trans_choice('labels.backend.stripe.plan.bundle', $plan->bundle, ['quantity' => $plan->bundle])); ?></td>
                        </tr>
                        <tr>
                            <th>Selected Courses</th>
                            <th>
                                <?php if(count($plan->subcribeCourses)): ?>
                                    <?php $__currentLoopData = $plan->subcribeCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('courses.show', [$subCourse->course->slug])); ?>" target="_blank"><span class="badge badge-info" style="padding: 8px 11px;"><?php echo e($subCourse->course->title); ?></span></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <span class="badge badge-primary" style="padding: 8px 11px;">All</span>
                                <?php endif; ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Selected Bundle</th>
                            <th>
                                <?php if(count($plan->subcribeBundle)): ?>
                                    <?php $__currentLoopData = $plan->subcribeBundle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subBundle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('courses.show', [$subBundle->bundle->slug])); ?>" target="_blank"><span class="badge badge-info" style="padding: 8px 11px;"><?php echo e($subBundle->bundle->title); ?></span></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <span class="badge badge-primary" style="padding: 8px 11px;">All</span>
                                <?php endif; ?>
                            </th>
                        </tr>

                    </table>
                </div>
            </div><!-- Nav tabs -->


            <a href="<?php echo e(route('admin.stripe.plans.index')); ?>"
               class="btn btn-default border"><?php echo app('translator')->get('strings.backend.general.app_back_to_list'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\stripe\plan\show.blade.php ENDPATH**/ ?>