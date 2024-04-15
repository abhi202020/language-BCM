<?php $request = app('Illuminate\Http\Request'); ?>

<?php $__env->startSection('title', __('labels.backend.live_lessons.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->get('labels.backend.live_lessons.title'); ?></h3>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_create')): ?>
                <div class="float-right">
                    <a href="<?php echo e(route('admin.live-lessons.create')); ?><?php if(request('course_id')): ?><?php echo e('?course_id='.request('course_id')); ?><?php endif; ?>"
                       class="btn btn-success"><?php echo app('translator')->get('strings.backend.general.app_add_new'); ?></a>

                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('course_id', trans('labels.backend.live_lessons.fields.course'), ['class' => 'control-label']); ?>

                    <?php echo Form::select('course_id', $courses,  (request('course_id')) ? request('course_id') : old('course_id'), ['class' => 'form-control js-example-placeholder-single select2 ', 'id' => 'course_id']); ?>

                </div>
            </div>
            <div class="d-block">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="<?php echo e(route('admin.live-lessons.index',['course_id'=>request('course_id')])); ?>"
                           style="<?php echo e(request('show_deleted') == 1 ? '' : 'font-weight: 700'); ?>"><?php echo e(trans('labels.general.all')); ?></a>
                    </li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_delete')): ?>
                        |
                        <li class="list-inline-item">
                            <a href="<?php echo e(trashUrl(request())); ?>"
                               style="<?php echo e(request('show_deleted') == 1 ? 'font-weight: 700' : ''); ?>"><?php echo e(trans('labels.general.trash')); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <?php if(request('course_id') != "" || request('show_deleted') != ""): ?>
                <div class="table-responsive">

                    <table id="myTable"
                           class="table table-bordered table-striped <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_delete')): ?> <?php if( request('show_deleted') != 1 ): ?> dt-select <?php endif; ?> <?php endif; ?>">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('labels.general.sr_no'); ?></th>

                            <th><?php echo app('translator')->get('labels.backend.live_lessons.fields.title'); ?></th>
                            <?php if( request('show_deleted') == 1 ): ?>
                                <th><?php echo app('translator')->get('strings.backend.general.actions'); ?> &nbsp;</th>
                            <?php else: ?>
                                <th><?php echo app('translator')->get('strings.backend.general.actions'); ?> &nbsp;</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            <?php endif; ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>

        $(document).ready(function () {
            var route = '<?php echo e(route('admin.live-lessons.get_data')); ?>';


            <?php
            $show_deleted = (request('show_deleted') == 1) ? 1 : 0;
            $course_id = (request('course_id') != "") ? request('course_id') : 0;
            $route = route('admin.live-lessons.get_data',['show_deleted' => $show_deleted,'course_id' => $course_id]);
            ?>

            route = '<?php echo e($route); ?>';
            route = route.replace(/&amp;/g, '&');

            <?php if(request('course_id') != "" || request('show_deleted') != ""): ?>

            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 0,1]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0, 1]
                        }
                    },
                    'colvis'
                ],
                ajax: route,
                columns: [
                    {data: "DT_RowIndex", name: 'DT_RowIndex', searchable: false, orderable:false},
                    {data: "title", name: 'title'},
                    {data: "actions", name: "actions"}
                ],
                <?php if(request('show_deleted') != 1): ?>
                columnDefs: [
                    {"width": "5%", "targets": 0},
                    {"className": "text-center", "targets": [0]}
                ],
                <?php endif; ?>

                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-entry-id', data.id);
                },
                language:{
                    url : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo e($locale_full_name); ?>.json",
                    buttons :{
                        colvis : '<?php echo e(trans("datatable.colvis")); ?>',
                        pdf : '<?php echo e(trans("datatable.pdf")); ?>',
                        csv : '<?php echo e(trans("datatable.csv")); ?>',
                    }
                }
            });

            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('live_lesson_delete')): ?>
            <?php if(request('show_deleted') != 1): ?>
            $('.actions').html('<a href="' + '<?php echo e(route('admin.lessons.mass_destroy')); ?>' + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
            <?php endif; ?>
            <?php endif; ?>


            $(".js-example-placeholder-single").select2({
                placeholder: "<?php echo e(trans('labels.backend.live_lessons.select_course')); ?>",
            });
            $(document).on('change', '#course_id', function (e) {
                var course_id = $(this).val();
                window.location.href = "<?php echo e(route('admin.live-lessons.index')); ?>" + "?course_id=" + course_id
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/backend/live-lessons/index.blade.php ENDPATH**/ ?>