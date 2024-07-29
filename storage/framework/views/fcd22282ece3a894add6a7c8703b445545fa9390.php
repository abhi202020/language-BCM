
<?php $__env->startSection('title', __('labels.backend.questions.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <?php echo Form::model($question, ['method' => 'PUT', 'route' => ['admin.questions.update', $question->id], 'files' => true,]); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.questions.edit'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.questions.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.questions.view'); ?></a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('question',  trans('labels.backend.questions.fields.question').'*', ['class' => 'control-label']); ?>

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
                <?php if($question->question_image): ?>
                    <div class="col-9">
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

                    <div class="col-1 form-group">
                        <a href="<?php echo e(asset('storage/uploads/'.$question->question_image)); ?>" target="_blank">
                            <img height="70px" src="<?php echo e(asset('storage/uploads/'.$question->question_image)); ?>"></a>
                    </div>
                <?php else: ?>
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
                <?php endif; ?>

            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('score', trans('labels.backend.questions.fields.score').'*', ['class' => 'control-label']); ?>

                    <?php echo Form::number('score', old('score'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']); ?>

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

                    <?php echo Form::select('tests[]', $tests, old('tests') ? old('tests') : $question->tests->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'required' => true]); ?>

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
    <?php if($question->options->count()): ?>
    <?php echo Form::hidden('options_available', 1); ?>

    <?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $key++ ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <?php echo Form::label('option_text_' . $option->id, trans('labels.backend.questions.fields.option_text').'*', ['class' => 'control-label']); ?>

                        <?php echo Form::textarea('option_text_' . $key, $option->option_text, ['class' => 'form-control ', 'rows' => 3, 'required' => true]); ?>

                        <p class="help-block"></p>
                        <?php if($errors->has('option_text_' . $option->id)): ?>
                            <p class="help-block">
                                <?php echo e($errors->first('option_text_' . $option->id)); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 form-group">
                        <?php echo Form::label('explanation_' . $option->id, trans('labels.backend.questions.fields.option_explanation').'*', ['class' => 'control-label']); ?>

                        <?php echo Form::textarea('explanation_' . $key, $option->explanation, ['class' => 'form-control ', 'rows' => 3]); ?>

                        <p class="help-block"></p>
                        <?php if($errors->has('explanation_' . $option->id)): ?>
                            <p class="help-block">
                                <?php echo e($errors->first('explanation_' . $option->id)); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 form-group">
                        <?php echo Form::label('correct_' . $key, trans('labels.backend.questions.fields.correct'), ['class' => 'control-label']); ?>

                        <?php echo Form::hidden('correct_' . $option->id, 0); ?>

                        <?php echo Form::hidden('option_id_'.$key,  $option->id ); ?>

                        <?php echo Form::checkbox('correct_' . $key, 1, ($option->correct == 1) ? true : false, []); ?>

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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
    <?php echo Form::hidden('options_available', 0); ?>

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
    <?php endif; ?>
    <div class="row">
        <div class="col-12 text-center mb-4">
            <?php echo Form::submit(trans('strings.backend.general.app_update'), ['class' => 'btn btn-danger']); ?>


        </div>
    </div>


    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\questions\edit.blade.php ENDPATH**/ ?>