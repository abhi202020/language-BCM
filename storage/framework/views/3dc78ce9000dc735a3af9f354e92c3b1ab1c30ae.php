
<?php $__env->startSection('title', __('labels.backend.faqs.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.questions.title'); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.questions.fields.question'); ?></th>
                            <td><?php echo $question->question; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.questions.fields.question_image'); ?></th>
                            <td><?php if($question->question_image): ?><a
                                        href="<?php echo e(asset('storage/uploads/' . $question->question_image)); ?>"
                                        target="_blank"><img
                                            src="<?php echo e(asset('storage/uploads/' . $question->question_image)); ?>"
                                            height="50px"/></a><?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.questions.fields.score'); ?></th>
                            <td><?php echo e($question->score); ?></td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="nav-item">
                    <a href="#questionsoptions" class="nav-link active" aria-controls="questionsoptions" role="tab"
                       data-toggle="tab">Questions options</a>
                </li>
                <li role="presentation" class="nav-item">
                    <a href="#tests" class="nav-link" aria-controls="tests" role="tab" data-toggle="tab">Tests</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane container active" id="questionsoptions">
                    <table class="table table-bordered table-striped <?php echo e(count($questions_options) > 0 ? 'datatable' : ''); ?>">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.questions_options.fields.question'); ?></th>
                            <th><?php echo app('translator')->get('labels.backend.questions_options.fields.option_text'); ?></th>
                            <th><?php echo app('translator')->get('labels.backend.questions_options.fields.correct'); ?></th>
                            <?php if( request('show_deleted') == 1 ): ?>
                                <th><?php echo app('translator')->get('labels.general.actions'); ?></th>
                            <?php else: ?>
                                <th><?php echo app('translator')->get('labels.general.actions'); ?></th>
                            <?php endif; ?>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(count($questions_options) > 0): ?>
                            <?php $__currentLoopData = $questions_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $questions_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr data-entry-id="<?php echo e($questions_option->id); ?>">
                                    <td><?php echo e(($questions_option->question) ? $questions_option->question->question : ''); ?></td>
                                    <td><?php echo $questions_option->option_text; ?></td>
                                    <td><?php echo e(Form::checkbox("correct", 1, $questions_option->correct == 1 ? true : false, ["disabled"])); ?></td>
                                    <?php if( request('show_deleted') == 1 ): ?>
                                        <td>

                                            <a data-method="delete" data-trans-button-cancel="Cancel"
                                               data-trans-button-confirm="Restore" data-trans-title="Are you sure?"
                                               class="btn btn-xs mb-2  btn-success" style="cursor:pointer;"
                                               onclick="$(this).find('form').submit();">
                                                <?php echo e(trans('strings.backend.general.app_restore')); ?>

                                                <form action="<?php echo e(route('admin.questions_options.restore',['questions_option'=> $questions_option->id ])); ?>"
                                                      method="POST" name="delete_item" style="display:none">
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </a>


                                            <a data-method="delete" data-trans-button-cancel="Cancel"
                                               data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                               class="btn btn-xs mb-2 btn-danger" style="cursor:pointer;"
                                               onclick="$(this).find('form').submit();">
                                                <?php echo e(trans('strings.backend.general.app_permadel')); ?>

                                                <form action="<?php echo e(route('admin.questions_options.perma_del',['questions_option'=>$questions_option->id])); ?>"
                                                      method="POST" name="delete_item" style="display:none">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo e(method_field('DELETE')); ?>

                                                </form>
                                            </a>

                                    <?php else: ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('questions_option_view')): ?>
                                                <a href="<?php echo e(route('admin.questions_options.show',[$questions_option->id])); ?>"
                                                   class="btn btn-xs mb-2 btn-primary"><i class="icon-eye"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('questions_option_edit')): ?>
                                                <a href="<?php echo e(route('admin.questions_options.edit',[$questions_option->id])); ?>"
                                                   class="btn btn-xs mb-2 btn-info"><i class="icon-pencil"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('questions_option_delete')): ?>

                                                <a data-method="delete" data-trans-button-cancel="Cancel"
                                                   data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                                   class="btn btn-xs mb-2 btn-danger" style="cursor:pointer;"
                                                   onclick="$(this).find('form').submit();">
                                                    <i class="fa fa-trash"></i>
                                                    <form action="<?php echo e(route('admin.questions_options.destroy',['questions_option'=> $questions_option->id])); ?>"
                                                          method="POST" name="delete_item" style="display:none">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo e(method_field('DELETE')); ?>

                                                    </form>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><?php echo app('translator')->get('strings.backend.general.app_no_entries_in_table'); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane container" id="tests">
                    <table class="table table-bordered table-striped <?php echo e(count($tests) > 0 ? 'datatable' : ''); ?>">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('labels.backend.tests.fields.course'); ?></th>
                            <th><?php echo app('translator')->get('labels.backend.tests.fields.lesson'); ?></th>
                            <th><?php echo app('translator')->get('labels.backend.tests.fields.title'); ?></th>
                            <th><?php echo app('translator')->get('labels.backend.tests.fields.questions'); ?></th>
                            <th><?php echo app('translator')->get('labels.backend.tests.fields.published'); ?></th>
                            <?php if( request('show_deleted') == 1 ): ?>
                                <th><?php echo app('translator')->get('labels.general.actions'); ?></th>
                            <?php else: ?>
                                <th><?php echo app('translator')->get('labels.general.actions'); ?></th>
                            <?php endif; ?>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(count($tests) > 0): ?>
                            <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr data-entry-id="<?php echo e($test->id); ?>">
                                    <td><?php echo e(($test->course) ? $test->course->title : ''); ?></td>
                                    <td><?php echo e(($test->lesson) ? $test->lesson->title : ''); ?></td>
                                    <td><?php echo e($test->title); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $test->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleQuestions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="label label-info label-many"><?php echo e($singleQuestions->question); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e(Form::checkbox("published", 1, $test->published == 1 ? true : false, ["disabled"])); ?></td>
                                    <?php if( request('show_deleted') == 1 ): ?>
                                        <td>

                                            <a data-method="delete" data-trans-button-cancel="Cancel"
                                               data-trans-button-confirm="Restore" data-trans-title="Are you sure?"
                                               class="btn btn-xs mb-2  btn-success" style="cursor:pointer;"
                                               onclick="$(this).find('form').submit();">
                                                <?php echo e(trans('strings.backend.general.app_restore')); ?>

                                                <form action="<?php echo e(route('admin.tests.restore',['test'=> $test->id ])); ?>"
                                                      method="POST" name="delete_item" style="display:none">
                                                    <?php echo csrf_field(); ?>
                                                </form>
                                            </a>


                                            <a data-method="delete" data-trans-button-cancel="Cancel"
                                               data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                               class="btn btn-xs mb-2 btn-danger" style="cursor:pointer;"
                                               onclick="$(this).find('form').submit();">
                                                <?php echo e(trans('strings.backend.general.app_permadel')); ?>

                                                <form action="<?php echo e(route('admin.tests.perma_del',['test'=>$test->id])); ?>"
                                                      method="POST" name="delete_item" style="display:none">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo e(method_field('DELETE')); ?>

                                                </form>
                                            </a>

                                        </td>
                                    <?php else: ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('test_view')): ?>
                                                <a href="<?php echo e(route('admin.tests.show',[$test->id])); ?>"
                                                   class="btn btn-xs mb-2 btn-primary">
                                                    <i class="icon-eye"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('test_edit')): ?>
                                                <a href="<?php echo e(route('admin.tests.edit',[$test->id])); ?>"
                                                   class="btn btn-xs mb-2 btn-info">
                                                    <i class="icon-pencil"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('test_delete')): ?>

                                                    <a data-method="delete" data-trans-button-cancel="Cancel"
                                                       data-trans-button-confirm="Delete" data-trans-title="Are you sure?"
                                                       class="btn btn-xs mb-2 btn-danger" style="cursor:pointer;"
                                                       onclick="$(this).find('form').submit();">
                                                        <i class="fa fa-trash"></i>
                                                        <form action="<?php echo e(route('admin.tests.destroy',['test'=> $test->id])); ?>"
                                                              method="POST" name="delete_item" style="display:none">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo e(method_field('DELETE')); ?>

                                                        </form>
                                                    </a>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10"><?php echo app('translator')->get('strings.backend.general.app_no_entries_in_table'); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <a href="<?php echo e(route('admin.questions.index')); ?>"
               class="btn btn-default border mt-3"><?php echo app('translator')->get('strings.backend.general.app_back_to_list'); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views\backend\faqs\show.blade.php ENDPATH**/ ?>