

<?php $__env->startSection('title',  __('labels.backend.update.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        ul.file-list{
            border: 2px solid;
            height: 300px;
            overflow: scroll;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="page-title d-inline"><?php echo app('translator')->get('labels.backend.update.title'); ?></h3>
                    <h3 class="float-right text-primary"><?php echo app('translator')->get('labels.backend.update.current_version'); ?> <?php echo e(config('app.version')); ?></h3>

                </div><!--card-header-->
                <div class="card-body">
                    <h4><?php echo app('translator')->get('labels.backend.update.file_replaced'); ?></h4>
                    <ul class="file-list">
                        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($file); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <form method="post" id="update-files" action="<?php echo e(route('admin.update-files')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="file_name" value="<?php echo e($file_name); ?>">

                        <div class="form-group col-12 ">
                            <button value="cancel" name="submit" class="btn btn-danger mt-auto mr-5"
                                    ><?php echo app('translator')->get('labels.general.buttons.cancel'); ?></button>
                            <button value="update" name="submit" class="btn btn-primary mt-auto"
                                    ><?php echo app('translator')->get('labels.general.buttons.update'); ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('click','button[name="submit"]',function (e) {
                $('#update-files').submit();
            });
        })

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\update\file-list.blade.php ENDPATH**/ ?>