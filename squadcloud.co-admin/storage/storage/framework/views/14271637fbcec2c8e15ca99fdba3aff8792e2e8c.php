<div class="">
    <div class="contractor-slider">
        <?php $__currentLoopData = $resellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card contractor">
            <div style="padding: 40px 30px 0;">
                <div class="image-header">
                    <img src="<?php echo e(asset('reseller-images/'.$item->image)); ?>" alt="" srcset="" class="img-fluid">
                </div>
                <p class="para_download text-white"><?php echo e($item->email); ?></p>
                <p class="para_mb text-white"><?php echo e($item->username); ?></p>
                <p style="text-align:center" class=" text-white"><?php echo e($item->area); ?></p>
                <div class="image-footer">
                    <p><?php echo e($item->city); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/livewire/front/reseller-detail.blade.php ENDPATH**/ ?>