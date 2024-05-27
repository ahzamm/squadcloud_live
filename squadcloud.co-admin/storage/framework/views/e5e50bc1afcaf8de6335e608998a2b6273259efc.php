<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 
 <?php $__env->startPush('style'); ?>
 <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/css/select2.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('site/sweet-alert/sweetalert2.css')); ?>">
 <?php $__env->stopPush(); ?>
 <?php $__env->startSection('content'); ?>
 <?php
 $action = $data['action'];
 if($action == "create"){
 $parentRoute = Route("email.store");
 $parentTitle = "SMTP Configration";
}
if($action == "edit"){
$id = $data['email'] -> id ;
$parentRoute = Route("email.update" , $id);
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
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-envelope"></i></span> <?php echo e($parentTitle); ?></h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('email.index')); ?>">
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
                    <label for="">SMTP SERVER <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="smtp_server" placeholder="Example : smtp.gmail.com" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">SMTP Port <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="port" placeholder="Example : 587" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email Address <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="email" placeholder="Example : abc@gmail.com" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email Password <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="password" placeholder="Example : 123abc" required>
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
    if ($('input[name="smtp_server"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Smtp server is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
    if ($('input[name="port"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Smtp Port is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
    if ($('input[name="email"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Smtp email is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
    if ($('input[name="password"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Smtp password is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
  });
  let action = "<?php echo e($action); ?>";
  let socialData = <?php echo isset($data['email']) && $data['email']  ? $data['email'] : 0 ?>;
  if (action == "edit") {
    $('input[name="smtp_server"]').val(socialData.smtp_server);
    $('input[name="port"]').val(socialData.port);
    $('input[name="email"]').val(socialData.emails);
    $('input[name="password"]').val(socialData.smtp_password);
    let status = socialData.status == "1" ? "on" : "off";
    status == "on" ? $('input[name="status"]').prop('checked', true) : $('input[name="status"]').prop('checked', false);
  }
</script>
<?php $__env->stopPush(); ?>
<!-- Code Finalize -->
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/Email/create.blade.php ENDPATH**/ ?>