
<?php $__env->startSection('title', __('labels.backend.blogs.title').' | '.app_name()); ?>

<?php $__env->startPush('after-styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>">
    <style>
        .select2-container--default .select2-selection--single {
            height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px;
        }

        .bootstrap-tagsinput{
            width: 100%!important;
            display: inline-block;
        }

        .bootstrap-tagsinput .tag{
            line-height: 1;
            margin-right: 2px;
            background-color: #2f353a ;
            color: white;
            padding: 3px;
            border-radius: 3px;
        }

        .btn-danger.remove-paragraph-btn {
            background-color: #dc3545; /* Red color */
            color: #fff; /* Text color */
        }

    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['method' => 'POST', 'route' => ['admin.blogs.store'], 'files' => true,]); ?>


    <div class="card">
        <div class="card-header">
            <h3 class="page-title float-left mb-0"><?php echo app('translator')->get('labels.backend.blogs.create'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.blogs.index')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.blogs.view'); ?></a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('title', trans('labels.backend.blogs.fields.title'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.blogs.fields.title'), ]); ?>

                </div>
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('category', trans('labels.backend.blogs.fields.category'), ['class' => 'control-label']); ?>

                    <?php echo Form::select('category', $category,  (request('category')) ? request('category') : old('category'), ['class' => 'form-control select2']); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('slug',trans('labels.backend.blogs.fields.slug'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.lessons.slug_placeholder')]); ?>

                </div>
                <div class="col-12 col-lg-6 form-group">
                    <?php echo Form::label('featured_image', trans('labels.backend.blogs.fields.featured_image').' '.trans('labels.backend.blogs.max_file_size'), ['class' => 'control-label']); ?>

                    <?php echo Form::file('featured_image', ['class' => 'form-control' , 'accept' => 'image/jpeg,image/gif,image/png']); ?>

                    <?php echo Form::hidden('featured_image_max_size', 8); ?>

                    <?php echo Form::hidden('featured_image_max_width', 4000); ?>

                    <?php echo Form::hidden('featured_image_max_height', 4000); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('content', trans('labels.backend.blogs.fields.content'), ['class' => 'control-label']); ?>

                    <div id="content-container">
                        <div class="content-box">
                            <?php echo Form::textarea('content[]', old('content'), ['class' => 'form-control editor', 'placeholder' => '', 'id' => 'editor_1']); ?>

                            <button type="button" class="btn btn-primary add-paragraph-btn">Add New Paragraph</button>
                            <button type="button" class="btn btn-danger remove-paragraph-btn">Remove Paragraph</button>
                            <button type="button" class="btn btn-success add-button-btn">Add Button</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <?php echo Form::text('tags', old('tags'), ['class' => 'form-control','data-role' => 'tagsinput', 'placeholder' => trans('labels.backend.blogs.fields.tags_placeholder'),'id'=>'tags']); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-12 form-group">
                    <?php echo Form::label('meta_title',trans('labels.backend.blogs.fields.meta_title'), ['class' => 'control-label']); ?>

                    <?php echo Form::text('meta_title', old('meta_title'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.blogs.fields.meta_title')]); ?>

                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('meta_description',trans('labels.backend.blogs.fields.meta_description'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('meta_description', old('meta_description'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.blogs.fields.meta_description')]); ?>

                </div>
                <div class="col-12 form-group">
                    <?php echo Form::label('meta_keywords',trans('labels.backend.blogs.fields.meta_keywords'), ['class' => 'control-label']); ?>

                    <?php echo Form::textarea('meta_keywords', old('meta_keywords'), ['class' => 'form-control', 'placeholder' => trans('labels.backend.blogs.fields.meta_keywords')]); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center form-group">
                    <button type="submit" class="btn btn-info waves-effect waves-light ">
                       <?php echo e(trans('labels.backend.blogs.fields.publish')); ?>

                    </button>
                    <button type="reset" class="btn btn-danger waves-effect waves-light ">
                       <?php echo e(trans('labels.backend.blogs.fields.clear')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script src="<?php echo e(asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendor/laravel-filemanager/js/lfm.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            var editorCount = 1;

            function initializeEditor(id) {
                CKEDITOR.replace(id, {
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=<?php echo e(csrf_token()); ?>',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=<?php echo e(csrf_token()); ?>',
                    extraPlugins: 'colorbutton',
                    toolbar: [
                        { name: 'document', items: ['Source'] },
                        { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                        { name: 'editing', items: ['Find', 'Replace', 'SelectAll', 'SpellChecker'] },
                        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'] },
                        { name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'] },
                        { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                        { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
                        { name: 'tools', items: ['Maximize'] },
                        { name: 'colors', items: ['TextColor', 'BGColor'] },
                    ],
                    removeButtons: 'Subscript,Superscript,Anchor,Maximize,ShowBlocks,About',
                    format_tags: 'p;h1;h2;h3;pre',
                });
            }

            // Initial editor setup for the first content box
            initializeEditor('editor_1');

            $('#content-container').on('click', '.add-paragraph-btn', function () {
                // Create a new content box
                var newContentBox = $('<div class="content-box"></div>');

                // Clone the first textarea
                var newTextarea = $('.content-box:first').find('textarea').clone();

                // Remove the ID attribute from the cloned textarea
                newTextarea.removeAttr('id').val('');

                // Append the cloned textarea to the new content box
                newContentBox.append(newTextarea);

                // Add buttons to the new content box
                newContentBox.append('<button type="button" class="btn btn-primary add-paragraph-btn">Add New Paragraph</button>');
                newContentBox.append('<button type="button" class="btn btn-remove remove-paragraph-btn">Remove Paragraph</button>');

                // Append the new content box to the container
                $('#content-container').append(newContentBox);

                // Generate a new editor ID and set it for the cloned textarea
                var newEditorId = 'editor_' + (editorCount + 1);
                newTextarea.attr('id', newEditorId);

                // Initialize CKEditor for the new textarea
                initializeEditor(newEditorId);

                // Update the editorCount
                editorCount++;
            });

            $('#content-container').on('click', '.add-button-btn', function () {
                var buttonHtml = '<button class="btn btn-primary">Your Button Text</button>';
                var currentTextarea = $(this).siblings('textarea');
                var currentContent = currentTextarea.val();
                currentTextarea.val(currentContent + '\n' + buttonHtml);
            });

            $('#content-container').on('click', '.remove-paragraph-btn', function () {
                // Ensure that at least one content box remains
                if ($('#content-container .content-box').length > 1) {
                    var contentBox = $(this).closest('.content-box');
                    contentBox.remove();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/backend/blogs/create.blade.php ENDPATH**/ ?>