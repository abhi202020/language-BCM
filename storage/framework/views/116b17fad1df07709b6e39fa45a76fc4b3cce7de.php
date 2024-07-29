
<?php $__env->startSection('title', __('labels.backend.faqs.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['method' => 'POST', 'route' => ['admin.faqs.store'], 'files' => true,]); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.faqs.create'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.faqs.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.faqs.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('category', trans('labels.backend.blogs.fields.category'), ['class' => 'control-label']); ?>

                    <?php echo Form::select('category', $category,  (request('category')) ? request('category') : old('category'), ['class' => 'form-control select2']); ?>

                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('question', trans('labels.backend.faqs.fields.question'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('question', old('question'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.faqs.fields.question')]); ?>


                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('answer', trans('labels.backend.faqs.fields.answer'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('answer', old('answer'), ['class' => 'form-control ', 'placeholder' =>  trans('labels.backend.faqs.fields.answer')]); ?>


                </div>
            </div>
        </div>
    </div>


    <div class="col-12 text-center">
        <?php echo Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']); ?>

    </div>

    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\faqs\create.blade.php ENDPATH**/ ?>