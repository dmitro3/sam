<?php $__env->startSection('page-title', trans('app.info')); ?>
<?php $__env->startSection('page-heading', trans('app.info')); ?>

<?php $__env->startSection('content'); ?>

	<section class="content-header">
		<?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</section>

	<section class="content">


		<form action="" method="GET">
			<div class="box box-danger collapsed-box info_show">
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo app('translator')->get('app.filter'); ?></h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label><?php echo app('translator')->get('app.search'); ?></label>
								<input type="text" class="form-control" name="search" value="<?php echo e(Request::get('search')); ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><?php echo app('translator')->get('app.role'); ?></label>
								<?php echo Form::select('role', ['' => __('app.all')] + array_combine($roles, $roles), Request::get('role'), ['id' => 'role', 'class' => 'form-control']); ?>

							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">
						<?php echo app('translator')->get('app.filter'); ?>
					</button>

				</div>
			</div>
		</form>


		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Helper</h3>
				<div class="pull-right box-tools">
					<a href="<?php echo e(route('backend.info.create')); ?>" class="btn btn-block btn-primary btn-sm"><?php echo app('translator')->get('app.add'); ?></a>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
						<tr>
							<th><?php echo app('translator')->get('app.title'); ?></th>
							<th><?php echo app('translator')->get('app.roles'); ?></th>
							<th><?php echo app('translator')->get('app.days'); ?></th>
						</tr>
						</thead>
						<tbody>
						<?php if(count($info)): ?>
							<?php $__currentLoopData = $info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('backend.info.partials.row', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
							<tr><td colspan="3"><?php echo app('translator')->get('app.no_data'); ?></td></tr>
						<?php endif; ?>
						</tbody>
						<thead>
						<tr>
							<th><?php echo app('translator')->get('app.title'); ?></th>
							<th><?php echo app('translator')->get('app.roles'); ?></th>
							<th><?php echo app('translator')->get('app.days'); ?></th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

	</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
	<script>

		$(function() {
			$('.btn-box-tool').click(function(event){
				if( $('.info_show').hasClass('collapsed-box') ){
					$.cookie('info_show', '1');
				} else {
					$.removeCookie('info_show');
				}
			});

			if( $.cookie('info_show') ){
				$('.info_show').removeClass('collapsed-box');
				$('.info_show .btn-box-tool i').removeClass('fa-plus').addClass('fa-minus');
			}
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\Gs85\resources\views/backend/info/list.blade.php ENDPATH**/ ?>