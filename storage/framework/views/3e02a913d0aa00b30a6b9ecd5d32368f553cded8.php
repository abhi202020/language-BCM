<?php $__env->startSection('content'); ?>
<section class="discussion-header">
	<div class="container">
		<div class="row">
			<div class="col-12 d-none d-md-flex flex-column flex-md-row align-items-center pt-3 pb-3">
				<a class="btn btn-secondary p-2 rounded-circle mr-3 lh-normal" href="/<?php echo e(config('chatter.routes.home')); ?>"><i class="fas fa-chevron-left d-flex align-items-center"></i></a>
				<h1 class="mb-0 flex-grow-1 text-primary"><?php echo e($discussion->title); ?></h1>
				<span class="text-softwhite"><?php echo app('translator')->get('chatter::messages.discussion.head_details'); ?><a class="badge p-2 text-white ml-2" href="/<?php echo e(config('chatter.routes.home')); ?>/<?php echo e(config('chatter.routes.category')); ?>/<?php echo e($discussion->category->slug); ?>" style="background-color:<?php echo e($discussion->category->color); ?>"><?php echo e($discussion->category->name); ?></a></span>
			</div>
			<div class="col-12 d-flex d-md-none flex-column flex-md-row align-items-center pt-3 pb-3">
				<div class="d-flex d-flex-row align-items-center">
					<a class="btn btn-secondary p-2 rounded-circle mr-3 lh-normal" href="/<?php echo e(config('chatter.routes.home')); ?>"><i class="fas fa-chevron-left d-flex align-items-center"></i></a>
					<span class="text-softwhite"><?php echo app('translator')->get('chatter::messages.discussion.head_details'); ?><a class="badge p-2 text-white ml-2" href="/<?php echo e(config('chatter.routes.home')); ?>/<?php echo e(config('chatter.routes.category')); ?>/<?php echo e($discussion->category->slug); ?>" style="background-color:<?php echo e($discussion->category->color); ?>"><?php echo e($discussion->category->name); ?></a></span>
				</div>
				<h1 class="mb-0 flex-grow-1 text-primary"><?php echo e($discussion->title); ?></h1>
			</div>
		</div>
	</div>
</section>

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

<section class="bg-darker forum pt-5 pb-5">
	<div class="container">
		<div class="row">
			<div class="col posts">
			<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="row post mb-3" data-id="<?php echo e($post->id); ?>">
				<!-- Left -->
				<div class="left col-12 col-sm-2 py-3">
					<div class="avatar">
						<?php if(config('chatter.user.avatar_image_database_field')): ?>
							<!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
							<?php if( (substr($post->user->getAttribute(config('chatter.user.avatar_image_database_field')), 0, 7) == 'http://') || (substr($post->user->getAttribute(config('chatter.user.avatar_image_database_field')), 0, 8) == 'https://') ): ?>
							<img src="<?php echo e($post->user->getAttribute(config('chatter.user.avatar_image_database_field'))); ?>" class="img-fluid d-block mx-auto rounded">
							<?php else: ?>
							<img src="<?php echo e(config('chatter.user.relative_url_to_image_assets') . $post->user->getAttribute(config('chatter.user.avatar_image_database_field'))); ?>" class="img-fluid d-block mx-auto rounded">
							<?php endif; ?>
						<?php else: ?>
							<p class="text-center lead">
								<span class="p-2 chatter_avatar_circle" style="background-color:#<?php echo e(\SkyRaptor\Chatter\Helpers\ChatterHelper::stringToColorCode($post->user->getAttribute(config('chatter.user.database_field_with_user_name')))); ?>">
									<?php echo e(strtoupper(substr($post->user->getAttribute(config('chatter.user.database_field_with_user_name')), 0, 1))); ?>

								</span>
							</p>
						<?php endif; ?>
					</div>
				</div>
				<!-- Left -->
				<!-- Right -->
				<div class="right col-12 col-sm-10 py-3">
					<div class="d-flex flex-column flex-grow-1 h-100">
						<!-- Post Details -->
						<div class="details text-center text-sm-left text-softwhite mb-2">
							<a class="lead" href="<?php echo e(\SkyRaptor\Chatter\Helpers\ChatterHelper::userLink($post->user)); ?>"><?php echo e(ucfirst($post->user->{config('chatter.user.database_field_with_user_name')})); ?></a> <span class="ago"><?php echo e(\Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans()); ?></span>
						</div>

						<!-- Content -->
						<div class="content d-flex flex-column flex-grow-1">
							<!-- Post Content -->
							<div class="main text-white">
								<div class="body text-break">
									<?php echo $post->body; ?>

								</div>
							</div>
						</div>
						<!-- /Content -->

						<!-- Actions -->
						<div class="actions pt-2 d-flex align-items-center justify-content-end">
							<?php if(!Auth::guest() && (Auth::user()->id == $post->user->id)): ?>
							<!-- Default Post actions -->
							<div class="chatter_post_actions">
								<button class="btn btn-secondary chatter_edit_btn">
									<i class="fas fa-edit"></i> <?php echo app('translator')->get('chatter::messages.words.edit'); ?>
								</button>
								<button class="btn btn-danger chatter_delete_btn" data-toggle="modal" data-target="#modal-delete-post-<?php echo e($post->id); ?>">
									<i class="fas fa-trash-alt"></i> <?php echo app('translator')->get('chatter::messages.words.delete'); ?>
								</button>

								<form class="post-edit-form d-none" action="/<?php echo e(config('chatter.routes.home') . '/posts/' . $post->id); ?>" method="POST">
									<?php echo method_field('PATCH'); ?>
									<?php echo csrf_field(); ?>
									<input type="hidden" name="body">
								</form>

								<form class="post-delete-form d-none" action="/<?php echo e(config('chatter.routes.home') . '/posts/' . $post->id); ?>" method="POST">
									<?php echo method_field('DELETE'); ?>
									<?php echo csrf_field(); ?>
								</form>

								<div class="modal fade" id="modal-delete-post-<?php echo e($post->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-delete-post-<?php echo e($post->id); ?>-label" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="modal-delete-post-<?php echo e($post->id); ?>-label"><?php echo app('translator')->get('chatter::messages.response.confirm'); ?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												...
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('chatter::messages.response.no_confirm'); ?></button>
												<button type="button" class="btn btn-primary btn-delete-post" post-id="<?php echo e($post->id); ?>"><?php echo app('translator')->get('chatter::messages.response.yes_confirm'); ?></button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Editing actions -->
							<div class="chatter_update_actions d-none">
								<button class="btn btn-secondary cancel_chatter_edit"><?php echo app('translator')->get('chatter::messages.words.cancel'); ?></button>
								<button class="btn btn-success update_chatter_edit"><i class="fas fa-check"></i><?php echo app('translator')->get('chatter::messages.response.update'); ?></button>
							</div>
							<?php endif; ?>
						</div>
						<!-- /Actions -->
					</div>
				</div>
				<!-- /Right -->
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-12">

				<div class="conversation">
					<ul class="posts pl-0">
						
					</ul>
				</div>

				<!-- Pagination -->
				<?php echo e($posts->links()); ?>

			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<hr class="mt-5 mb-5"/>
				<?php if(auth()->guard()->check()): ?>
				<h2 class="mb-4"><?php echo app('translator')->get('forum.newResponse'); ?></h2>
				<div id="new_response">
					<div id="new_discussion">
						<div class="chatter_loader dark" id="new_discussion_loader">
							<div></div>
						</div>

						<form id="chatter_form_editor" action="/<?php echo e(config('chatter.routes.home')); ?>/posts" method="POST">

							<!-- BODY -->
							<div id="editor">
								<label id="tinymce_placeholder" class="d-none"><?php echo app('translator')->get('chatter::messages.editor.tinymce_placeholder'); ?></label>
								<textarea id="body" class="richText" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
							</div>

							<input type="hidden" name="_token" id="csrf_token_field" value="<?php echo e(csrf_token()); ?>">
							<input type="hidden" name="chatter_discussion_id" value="<?php echo e($discussion->id); ?>">
						</form>

					</div><!-- #new_response -->
					<div id="discussion_response_email" class="p-2 bg-white">
						<button id="submit_response" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('chatter::messages.response.submit'); ?></button>
						<div class="clearfix"></div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(auth()->guard()->guest()): ?>
				<div id="login_or_register" class="text-white text-center">
					<p>
						<?php echo app('translator')->get('forum.messages.auth', ['login' => route('login.steam')]); ?>
					</p>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<input type="hidden" id="chatter_tinymce_toolbar" value="<?php echo e(config('chatter.tinymce.toolbar')); ?>">
<input type="hidden" id="chatter_tinymce_plugins" value="<?php echo e(config('chatter.tinymce.plugins')); ?>">
<input type="hidden" id="current_path" value="<?php echo e(Request::path()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection(config('chatter.yields.header')); ?>
<link href="<?php echo e(url('/vendor/skyraptor/chatter/assets/css/chatter.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection(config('chatter.yields.footer')); ?>
<script src="<?php echo e(url('/vendor/skyraptor/chatter/assets/js/chatter-discussion.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(config('chatter.master_file_extend'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\vendor\skyraptor\chatter\src\Views\discussion.blade.php ENDPATH**/ ?>