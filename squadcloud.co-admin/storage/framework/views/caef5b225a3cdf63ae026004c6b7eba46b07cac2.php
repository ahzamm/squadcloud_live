
<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('site/sweet-alert/sweetalert2.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php
$action = $data['action'];
if($action == "create"){
$parentRoute = Route("social.store");
$parentTitle = "Create";
}
if($action == "edit"){
$id = $data['data'] ;
$parentRoute = Route("social.update" , $id);
$parentTitle = "Update";
}
?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-brands fa-twitter"></i></span> <?php echo e($parentTitle); ?> Social Links</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('social.index')); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="<?php echo e($parentRoute); ?>" method="POST" id="submitForm" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Social Media Name <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="name" value="<?php echo e($data['data']->name ?? ""); ?>" placeholder="Example : Facebook" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Social Media Links (URL) <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="url" value="<?php echo e($data['data']->url ?? ""); ?>" placeholder="Example : https://www.facebook.com/blink" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Social Media Icon <span style="color: red">*</span></label>
                    <select class="form-control" name="icon" id="selectIcon">
                      <option value=>--Select Social Media Icon--</option>
                      <?php $__currentLoopData = $data['icons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($item); ?>"><?php echo e($item); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                </div>
             
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Color <span style="color: red">*</span></label>
                    <input type="color" class="form-control" name="color">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="status" id="checkboxSuccess1">
                      <label for="checkboxSuccess1">
                        Status (On & Off) <span style="color: red">*</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-primary float-right">Submit</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/plugins/select2/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/sweet-alert/sweetalert2.min.js')); ?>"></script>
<script>
  function formatState(state) {
    if (!state.id) {
      return state.text;
    }
    var $state = $(
      "<i class='" + state.element.value + "''></i> <span style='color:black;margin-left:10px'>" + state.element.value + "</span>"
      );
    return $state;
  }
  $(function() {
    $('.selectList').select2({
      theme: 'bootstrap4'
    })
    $('#selectIcon').select2({
      theme: 'bootstrap4',
      templateResult: formatState,
      templateSelection: formatState
    });
    $('.select2.select2-container').css('width', 'auto');
  })
  $(document).ready(function() {
    $('#pageContent').summernote({
      height: 300
    });
  });
  $("#submitForm").submit(function(e) {
    if ($('input[name="url"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Social Url is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
    if ($('select[name="icon"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Social icon is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
  });
  let action = "<?php echo e($action); ?>";
  let socialData = <?php echo isset($data['data']) && $data['data']  ? $data['data'] : 0 ?>;
  if (action == "edit") {
    $('input[name="url"]').val(socialData.url);
    $('select[name="icon"]').val(socialData.icon);
    $('input[name="color"]').val(socialData.color);
    let status = socialData.status == "1" ? "on" : "off";
    status == "on" ? $('input[name="status"]').prop('checked', true) : $('input[name="status"]').prop('checked', false);
  }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/social/create.blade.php ENDPATH**/ ?>