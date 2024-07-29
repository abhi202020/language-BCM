<?php $__env->startSection('content'); ?>
<?php if(config('chatter.errors')): ?>
<section class="alerts">
	<?php if(Session::has('chatter_alert')): ?>
		<div class="chatter-alert alert alert-dismissible alert-<?php echo e(Session::get('chatter_alert_type')); ?> rounded-0 font-weight-bold" role="alert">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<strong><i class="chatter-alert-<?php echo e(Session::get('chatter_alert_type')); ?>"></i> <?php echo e(config('chatter.alert_messages.' . Session::get('chatter_alert_type'))); ?></strong>
						<?php echo e(Session::get('chatter_alert')); ?>

					</div>
				</div>
			</div>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<i class="chatter-close fas fa-times-circle"></i>
			</button>
		</div>
		<div class="chatter-alert-spacer"></div>
	<?php endif; ?>

	<?php if(count($errors) > 0): ?>
		<div class="chatter-alert alert alert-dismissible alert-danger rounded-0 font-weight-bold" role="alert">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<p><strong><i class="chatter-alert-danger"></i> <?php echo app('translator')->get('chatter::alert.danger.title'); ?></strong> <?php echo app('translator')->get('chatter::alert.danger.reason.errors'); ?></p>
						<ul>
							<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><?php echo e($error); ?></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
				</div>
			</div>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<i class="chatter-close fas fa-times-circle"></i>
			</button>
		</div>
	<?php endif; ?>
</section>
<?php endif; ?>

<section class="bg-darker forum text-break pt-5">
	<div class="container">
		<div class="row">
			<!-- Sidebar -->
			<div class="col-lg-3 mb-3">
				<!-- New Discussion Button -->
				<button class="btn btn-block btn-primary mb-3" id="new_discussion_btn"><i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('chatter::messages.discussion.new'); ?></button>

				<!-- All Discussions Button -->
				<a href="/<?php echo e(config('chatter.routes.home')); ?>"><i class="chatter-bubble"></i> <?php echo app('translator')->get('chatter::messages.discussion.all'); ?></a>

				<!-- Category Filter Nav -->
				<div class="category-nav">
					<?php echo $categoriesMenu; ?>

				</div>
			</div>
			<!-- /Sidebar -->

			<!-- Discussions -->
			<div class="col-lg-9 discussions">
				<?php $__currentLoopData = $discussions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discussion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row discussion mb-3">
					<!-- Left -->
					<div class="left col-12 col-sm-2 py-3">
						<div class="avatar">
							<?php if(config('chatter.user.avatar_image_database_field')): ?>
								<!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
								<?php if( (substr($discussion->user->getAttribute(config('chatter.user.avatar_image_database_field')), 0, 7) == 'http://') || (substr($discussion->user->getAttribute(config('chatter.user.avatar_image_database_field')), 0, 8) == 'https://') ): ?>
								<img src="<?php echo e($discussion->user->getAttribute(config('chatter.user.avatar_image_database_field'))); ?>" class="img-fluid d-block mx-auto rounded">
								<?php else: ?>
								<img src="<?php echo e(config('chatter.user.relative_url_to_image_assets') . $discussion->user->getAttribute(config('chatter.user.avatar_image_database_field'))); ?>" class="img-fluid d-block mx-auto rounded">
								<?php endif; ?>
							<?php else: ?>
								<p class="text-center lead">
									<span class="p-2 chatter_avatar_circle" style="background-color:#<?php echo e(\SkyRaptor\Chatter\Helpers\ChatterHelper::stringToColorCode($discussion->user->getAttribute(config('chatter.user.database_field_with_user_name')))); ?>">
										<?php echo e(strtoupper(substr($discussion->user->getAttribute(config('chatter.user.database_field_with_user_name')), 0, 1))); ?>

									</span>
								</p>
							<?php endif; ?>
						</div>
					</div>
					<!-- /Left -->

					<!-- Right -->
					<div class="right col-12 col-sm-10 py-3">
						<div class="d-flex flex-column flex-grow-1 h-100">
							<!-- Post Title -->
							<div class="title d-flex flex-column flex-sm-row align-items-center mb-2">
								<a class="d-block w-100 text-center text-sm-left" href="/<?php echo e(config('chatter.routes.home')); ?>/<?php echo e(config('chatter.routes.discussion')); ?>/<?php echo e($discussion->category->slug); ?>/<?php echo e($discussion->slug); ?>">
									<h3 class="flex-grow-1 mb-0"><?php echo e($discussion->title); ?></h3>
								</a>
								<span class="category badge text-white p-2" style="background-color:<?php echo e($discussion->category->color); ?>"><?php echo e($discussion->category->name); ?></span>
							</div>

							<!-- Post Details -->
							<div class="details text-center text-sm-left text-softwhite mb-2">
								<a href="<?php echo e(\SkyRaptor\Chatter\Helpers\ChatterHelper::userLink($discussion->user)); ?>"><?php echo e(ucfirst($discussion->user->{config('chatter.user.database_field_with_user_name')})); ?></a> <span class="ago"><?php echo e(\Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans()); ?></span>
							</div>

							<!-- Content -->
							<div class="content d-flex flex-row flex-grow-1">
								<!-- Post Content -->
								<div class="main text-white">
									<div class="body text-break">
										<?php echo e(substr(strip_tags($discussion->post[0]->body), 0, 200)); ?><?php if(strlen(strip_tags($discussion->post[0]->body)) > 200): ?><?php echo e('...'); ?><?php endif; ?>
									</div>
								</div>
								<div class="p-3 text-primary text-center">
									<i class="fas fa-comments"></i>
									<div class="answer_count"><?php echo e($discussion->postsCount[0]->total); ?></div>
								</div>
							</div>
							<!-- /Content -->
						</div>
					</div>
					<!-- /Right -->
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<!-- Pagination -->
				<div class="row">
					<div class="col d-flex justify-content-center">
						<?php echo e($discussions->links()); ?>

					</div>
				</div>
			</div>
			<!-- /Discussions -->
		</div>
	</div>
</section>

<div id="new-discussion" class="fixed-bottom" style="display:none;">
	<div class="container bg-dark mh-50 overflow-auto pt-3 pb-3">
		<div class="d-none">
			<div id="new_discussion_loader"></div>
			<label id="tinymce_placeholder"><?php echo app('translator')->get('chatter::messages.editor.tinymce_placeholder'); ?></label>
		</div>

		<form id="chatter_form_editor" action="/<?php echo e(config('chatter.routes.home')); ?>/<?php echo e(config('chatter.routes.discussion')); ?>" method="POST">
			<div class="row mb-3 align-items-center">
				<div class="col-md-2 mb-3 mb-md-0 order-md-3">
					<button class="btn btn-block btn-danger cancel-discussion fas fa-times-circle" type="button"></button>
				</div>

				<div class="col-md-6 mb-3 mb-md-0">
					<!-- TITLE -->
					<input type="text" class="form-control" id="title" name="title" placeholder="<?php echo app('translator')->get('chatter::messages.editor.title'); ?>" value="<?php echo e(old('title')); ?>" >
				</div>

				<div class="col-md-4 mb-3 mb-md-0">
					<!-- CATEGORY -->
					<select id="chatter_category_id" class="form-control" name="chatter_category_id">
						<option value=""><?php echo app('translator')->get('chatter::messages.editor.select'); ?></option>
						<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if(old('chatter_category_id') == $category->id): ?>
								<option value="<?php echo e($category->id); ?>" selected><?php echo e($category->name); ?></option>
							<?php elseif(!empty($current_category_id) && $current_category_id == $category->id): ?>
								<option value="<?php echo e($category->id); ?>" selected><?php echo e($category->name); ?></option>
							<?php else: ?>
								<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
			</div><!-- .row -->

			<!-- BODY -->
			<div class="row mb-3">
				<div class="col-12">
					<textarea id="body" class="richText" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
				</div>
			</div>

			<input type="hidden" name="_token" id="csrf_token_field" value="<?php echo e(csrf_token()); ?>">

			<div class="row">
				<div class="col-12">
					<button class="btn btn-secondary cancel-discussion" type="button"><?php echo app('translator')->get('chatter::messages.words.cancel'); ?></button>
					<button id="submit_discussion" class="btn btn-success float-right" type="submit"><i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('chatter::messages.discussion.create'); ?></button>
					<div class="clearfix"></div>
				</div>
			</div>
		</form>
	</div>
</div>

<input type="hidden" id="chatter_tinymce_toolbar" value="<?php echo e(config('chatter.tinymce.toolbar')); ?>">
<input type="hidden" id="chatter_tinymce_plugins" value="<?php echo e(config('chatter.tinymce.plugins')); ?>">
<input type="hidden" id="current_path" value="<?php echo e(Request::path()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection(config('chatter.yields.header')); ?>
<link href="<?php echo e(url('/vendor/SkyRaptor/chatter/assets/css/chatter.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection(config('chatter.yields.footer')); ?>
<script src="<?php echo e(url('/vendor/SkyRaptor/chatter/assets/js/chatter-home.js')); ?>"></script>
<script>
	$('document').ready(function(){
		for (const element of document.querySelectorAll('.cancel-discussion')) {
			element.addEventListener('click', event => {
				$('#new-discussion').slideUp();
			});
		}

		document.querySelector('#new_discussion_btn').addEventListener('click', event => {
			<?php if(auth()->guard()->guest()): ?>
				window.location.href = "<?php echo e(route(config('chatter.routes.login'))); ?>";
			<?php endif; ?>
			<?php if(auth()->guard()->check()): ?>
				$('#new-discussion').slideDown();
				$('#title').focus();
			<?php endif; ?>
		});

		<?php if(count($errors) > 0): ?>
			$('#new-discussion').slideDown();
			$('#title').focus();
		<?php endif; ?>

	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(config('chatter.master_file_extend'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\vendor\skyraptor\chatter\src\Views\home.blade.php ENDPATH**/ ?>