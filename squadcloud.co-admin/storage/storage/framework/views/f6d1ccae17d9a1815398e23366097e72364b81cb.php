<div class="modal-header">

    <h5 class="modal-title" id="exampleModalLabel">Packages</h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

      <span aria-hidden="true">&times;</span>

    </button>

  </div>

  <div class="modal-body">

    <p class="text-center">Banner</p>

    <img src="<?php echo e(asset('slider_images/'.$packageData->package_slider_img)); ?>" alt="" srcset="" class="img-fluid" width="100%" style="height: 500px!important; object-fit:contain;">

    <dl class="mt-2">

        <dt>Internet package :</dt>
        <dd><?php echo e($packageData->name); ?></dd>
        <dt>Internet Bandwidth (Mbps) :</dt>
        <dd><?php echo e($packageData->limit); ?></dd>
        <dd>Internet Package Color Code :</dd>
        <dd><?php echo e($packageData->color); ?></dd>
        <dd>Province</dd>
        <dd><?php echo e($packageData->province); ?></dd>


    </dl>

  </div>

  <div class="modal-footer">

    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>

  </div>

<?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/packages/show-modal.blade.php ENDPATH**/ ?>