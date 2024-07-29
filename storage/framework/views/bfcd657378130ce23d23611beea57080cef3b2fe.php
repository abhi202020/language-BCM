

<?php $__env->startSection('title', __('labels.backend.teachers.title').' | '.app_name()); ?>
<?php $__env->startPush('after-styles'); ?>
<style>
    table th {
        width: 20%;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="card">

        <div class="card-header">
            <h3 class="page-title d-inline mb-0"><?php echo app('translator')->get('labels.backend.teachers.title'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.teachers.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.teachers.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.access.users.tabs.content.overview.name'); ?></th>
                            <td><?php echo e($teacher->name); ?></td>
                        </tr>

                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.access.users.tabs.content.overview.email'); ?></th>
                            <td><?php echo e($teacher->email); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.access.users.tabs.content.overview.status'); ?></th>
                            <td><?php echo $teacher->status_label; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.general_settings.user_registration_settings.fields.gender'); ?></th>
                            <td><?php echo $teacher->gender; ?></td>
                        </tr>
                        <?php
                            $teacherProfile = $teacher->teacherProfile?:'';
                            $payment_details = $teacher->teacherProfile?json_decode($teacher->teacherProfile->payment_details):new stdClass();
                        ?>
                        <tr>
                            <th><?php echo app('translator')->get('labels.teacher.facebook_link'); ?></th>
                            <td><?php echo $teacherProfile->facebook_link; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.teacher.twitter_link'); ?></th>
                            <td><?php echo $teacherProfile->twitter_link; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.teacher.linkedin_link'); ?></th>
                            <td><?php echo $teacherProfile->linkedin_link; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.teacher.payment_details'); ?></th>
                            <td><?php echo $teacherProfile->payment_method; ?></td>
                        </tr>
                        <?php if($teacherProfile->payment_method == 'bank'): ?>
                        <tr>
                            <th><?php echo app('translator')->get('labels.teacher.bank_details.name'); ?></th>
                            <td><?php echo $payment_details->bank_name; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.teacher.bank_details.bank_code'); ?></th>
                            <td><?php echo $payment_details->ifsc_code; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.teacher.bank_details.account'); ?></th>
                            <td><?php echo $payment_details->account_number; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.teacher.bank_details.holder_name'); ?></th>
                            <td><?php echo $payment_details->account_name; ?></td>
                        </tr>
                        <?php else: ?>
                        <tr>
                            <th><?php echo app('translator')->get('labels.teacher.paypal_email'); ?></th>
                            <td><?php echo $payment_details->paypal_email; ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div><!-- Nav tabs -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\teachers\show.blade.php ENDPATH**/ ?>