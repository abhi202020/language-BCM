
<?php $__env->startSection('title', __('labels.backend.blogs.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <style>
        .blog-detail-content p img{
            margin: 2px;
        }
        .label{
            margin-bottom: 5px;
            display: inline-block;
            border-radius: 0!important;
            font-size: 0.9em;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.blogs.view'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.blogs.fields.title'); ?></th>
                            <td><?php echo e($blog->title); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.blogs.fields.slug'); ?></th>
                            <td><?php echo e($blog->slug); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.blogs.fields.featured_image'); ?></th>
                            <td><?php if($blog->image): ?><a href="<?php echo e(asset('storage/uploads/' . $blog->image)); ?>" target="_blank"><img src="<?php echo e(asset('storage/uploads/' . $blog->image)); ?>" height="100px"/></a><?php endif; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.blogs.fields.content'); ?></th>
                            <td><?php echo $blog->content; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.blogs.fields.tags'); ?></th>
                            <td><?php echo e($blog->tags->pluck('name')->implode(',')); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.blogs.fields.meta_title'); ?></th>
                            <td><?php echo e($blog->meta_title); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.blogs.fields.meta_description'); ?></th>
                            <td><?php echo e($blog->meta_description); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.blogs.fields.meta_keywords'); ?></th>
                            <td><?php echo e($blog->meta_keywords); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.blogs.fields.created_at'); ?></th>
                            <td><?php echo e($blog->created_at->format('d M Y, h:i A')); ?></td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
            <!-- Tab panes -->
            <a href="<?php echo e(route('admin.blogs.index')); ?>" class="btn btn-default border"><?php echo app('translator')->get('strings.backend.general.app_back_to_list'); ?></a>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\blogs\show.blade.php ENDPATH**/ ?>