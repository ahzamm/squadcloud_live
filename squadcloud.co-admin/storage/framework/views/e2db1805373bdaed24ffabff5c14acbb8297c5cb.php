<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">FrontPage Slider</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <p class="text-center">Slide Image</p>
    <img src="<?php echo e(asset('homeslider/'.$homeslider->image)); ?>" alt="" srcset="" class="img-fluid" height="200">
    <dl class="mt-2">
        <dt>Slide Title :</dt>
        <dd><?php echo e($homeslider->title); ?></dd>

        <dt>Slide Slogan :</dt>
        <dd><?php echo e($homeslider->slogan); ?></dd>
    </dl>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  </div>
<?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/homeslider/show-modal.blade.php ENDPATH**/ ?>