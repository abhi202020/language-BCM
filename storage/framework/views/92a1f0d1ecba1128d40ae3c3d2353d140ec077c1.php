
<?php $__env->startSection('title', __('labels.backend.questions.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['method' => 'POST', 'route' => ['admin.questions.store'], 'files' => true,]); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.questions.create'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.questions.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.questions.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('question', trans('labels.backend.questions.fields.question').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('question', old('question'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('question')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('question')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('question_image', trans('labels.backend.questions.fields.question_image'), ['class' => 'control-label']); ?>

                    <?php echo Form::file('question_image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']); ?>

                    <?php echo Form::hidden('question_image_max_size', 8); ?>

                    <?php echo Form::hidden('question_image_max_width', 4000); ?>

                    <?php echo Form::hidden('question_image_max_height', 4000); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('question_image')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('question_image')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('score', trans('labels.backend.questions.fields.score').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::number('score', old('score', 1), ['class' => 'form-control', 'placeholder' => '', 'required' => '']); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('score')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('score')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('tests', trans('labels.backend.questions.fields.tests'), ['class' => 'control-label']); ?>

                    <?php echo Form::select('tests[]', $tests, old('tests'), ['class' => 'form-control select2 required', 'multiple' => 'multiple', 'required' => true]); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('tests')): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('tests')); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <?php for($question=1; $question<=4; $question++): ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('option_text_' . $question, trans('labels.backend.questions.fields.option_text').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('option_text_' . $question, old('option_text'), ['class' => 'form-control ', 'rows' => 3, 'required' =>  true]); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('option_text_' . $question)): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('option_text_' . $question)); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('explanation_' . $question, trans('labels.backend.questions.fields.option_explanation'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('explanation_' . $question, old('explanation_'.$question), ['class' => 'form-control ', 'rows' => 3]); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('explanation_' . $question)): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('explanation_' . $question)); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('correct_' . $question, trans('labels.backend.questions.fields.correct'), ['class' => 'control-label']); ?>

                    <?php echo Form::hidden('correct_' . $question, 0); ?>

                    <?php echo Form::checkbox('correct_' . $question, 1, false, []); ?>

                    <p class="help-block"></p>
                    <?php if($errors->has('correct_' . $question)): ?>
                        <p class="help-block">
                            <?php echo e($errors->first('correct_' . $question)); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endfor; ?>
    <div class="col-12 text-center">
        <?php echo Form::submit(trans('strings.backend.general.app_save'), ['class' => 'btn btn-danger mb-4 form-group']); ?>

    </div>

    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\questions\create.blade.php ENDPATH**/ ?>