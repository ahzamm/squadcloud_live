<div class="header-left">
	<?php if(empty($f_logo)): ?>
	<a class="logo-link logo-text" href="<?php echo e(route('home')); ?>"><img src="" alt="Blink Broadband" style="color: #fff;"/></a>
	<?php else: ?>
	<a class="logo-link logo-text" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(url('front-logo/'.$f_logo->image)); ?>" alt="best internet packages in Pakistan"/></a>
	<?php endif; ?>
	<div class="mobile-sidebar-trigger">
		<div class="st-sidebar-trigger-effects">
			<a class="float-sidebar-toggle-btn" data-effect="st-sidebar-effect-2"><i class="fa fa-bars"></i></a>
		</div>
	</div>
	<div class="mobile-main-menu-toggle" data-toggle="collapse" data-target=".collapse"><i class="fa fa-bars"></i></div>
</div>
<?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/livewire/front/front-logo.blade.php ENDPATH**/ ?>