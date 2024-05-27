<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel"><span><i class="fa-solid fa-location-dot"></i></span> Update City Zone Area</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="ipEditForm">
    <div class="alert bg-danger text-light pb-0" id="EditAllowedIpError" style="display: none">
    </div>
    <input type="hidden" name="id" value="<?php echo e($zoneArea->id); ?>">
    <div class="form-group">
      <label for="exampleInputEmail1">City Zone Name <span style="color: red">*</span></label>
      <input type="text" name="zone_name" value="<?php echo e($zoneArea->name); ?>" class="form-control">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Select City Core Area <span style="color: red">*</span></label>
      <select name="core_area" id="" class="form-control">
        <option value> Select City Core Area</option>
        <?php $__currentLoopData = $coreAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($item->id); ?>" <?php echo e($zoneArea->core_area_id == $item->id?'selected':''); ?>><?php echo e($item->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>
    <div class="form-group clearfix">
      <div class="icheck-success d-inline">
        <input type="checkbox"  <?php echo e($zoneArea->active == 1? 'checked' :'unchecked'); ?> name="active" id="checkboxSuccess1">
        <label for="checkboxSuccess1">
          Status (On & Off)
        </label>
      </div>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button"  class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
  <button type="submit" form="ipEditForm" class="btn btn-outline-primary">Update</button>
</div><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/zoneareas/edit.blade.php ENDPATH**/ ?>