<div class="panel-group" id="accordion-faq" role="tablist" aria-multiselectable="true">
  <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?php echo e($key); ?>">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion-faq" href="#collapse<?php echo e($key); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($key); ?>">
          <?php echo $item->question; ?>

        </a>
      </h4>
    </div>
    <div id="collapse<?php echo e($key); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo e($key); ?>">
      <div class="panel-body">
        <?php echo $item->answer; ?>

      </div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/livewire/front/faqs.blade.php ENDPATH**/ ?>