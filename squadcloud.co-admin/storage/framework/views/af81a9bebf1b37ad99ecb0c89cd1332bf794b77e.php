<li class="menu-item onepage-link-inside">
	<?php
		$menuCount = 0; 
	?>
	
	<?php $__currentLoopData = $data['menues']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($menuCount < 4): ?> <a class="onepage-link" href="#<?php echo e($menu->menu_id); ?>"><span><?php echo e($menu->menu); ?></span></a>
				<?php
					$menuCount++;
				?>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
	<?php if(isset($data['logo'])): ?>
		<a class="logo-link logo-text" href="<?php echo e(route('home')); ?>">
			<img src="<?php echo e(asset('front-logo/'.$data['logo']->image)); ?>" alt="<?php echo e($data['logo']->title); ?>">
		</a>
	<?php endif; ?>

	<?php $menuCount = 0; ?>
	<?php $__currentLoopData = $data['menues']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($menuCount >= 4 && $menu->menu_id != "Get Services"): ?> <!-- Display remaining menus after the logo and "Get Services" -->
			<a class="onepage-link" href="#<?php echo e($menu->menu_id); ?>"><span><?php echo e($menu->menu); ?></span></a>
		<?php elseif($menu->menu == "Get Services"): ?>
			<a class="onepage-link" href="javascript:void(0)" onclick="showModal()" id="get__modal"><span><?php echo e($menu->menu); ?> </span></a>
		<?php endif; ?>
		<?php $menuCount++; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</li><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/livewire/front/menu.blade.php ENDPATH**/ ?>