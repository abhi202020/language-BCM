
<?php $__env->startSection('title', __('labels.backend.pages.title').' | '.app_name()); ?>

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
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.pages.view'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">

                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.pages.fields.title'); ?></th>
                            <td><?php echo e($page->title); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.pages.fields.slug'); ?></th>
                            <td><?php echo e($page->slug); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.pages.fields.featured_image'); ?></th>
                            <td><?php if($page->image): ?><a href="<?php echo e(asset('storage/uploads/' . $page->image)); ?>" target="_blank"><img src="<?php echo e(asset('storage/uploads/' . $page->image)); ?>" height="100px"/></a><?php endif; ?></td>
                        </tr>

                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.pages.fields.content'); ?></th>
                            <td><?php echo $page->content; ?></td>
                        </tr>
                       
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.pages.fields.created_at'); ?></th>
                            <td><?php echo e($page->created_at->format('Y-m-d\TH:i')); ?></td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

            <!-- Tab panes -->


            <a href="<?php echo e(route('admin.pages.index')); ?>"
               class="btn btn-default border"><?php echo app('translator')->get('strings.backend.general.app_back_to_list'); ?></a>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/uat.margiesmagicalverbs.com/public_html/resources/views/backend/pages/show.blade.php ENDPATH**/ ?>