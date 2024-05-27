<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('sweet-alert/sweetalert2.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Edit Menu'); ?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><i class="fa-solid fa-bars"></i></span> Front Menu</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('frontmenu.index')); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <div class="card-header">
            <div class="row mt-5 justify-content-center">
              <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="card" style="border-color: rgb(126, 120, 120);">
                  <div class="card-header">
                    <h5 class="card-title">Update Main Menu</h5>
                  </div>
                  <div class="card-body">              
                    <form action="<?php echo e(route('frontmenu.update',$menus->id)); ?>" method="POST" id="AddMenusForm">
                      <?php echo method_field('PUT'); ?>
                      <?php echo csrf_field(); ?>
                      <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Main Menu Name <span style="color: red">*</span></label>
                            <input name="parentMenu" type="text" class="form-control" placeholder="Example : Contact Us" value="<?php echo e($menus->menu); ?>" required>
                          </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Main Menu (ID)<span style="color: red">*</span></label>
                            <input name="menu_id" type="text" class="form-control" placeholder="Example : Contact Us" value="<?php echo e($menus->menu_id); ?>" required>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <a class="btn btn-outline-secondary btn-sm float-right ml-2" href="<?php echo e(route('frontmenu.index')); ?>">Cancel</a>
                            <button class="btn btn-outline-primary btn-sm float-right" type="submit" id="menuBtn">Update</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/html" id="data-row">
  <tr>
    <td class="d-none">
      <input type="hidden" name="submenuId[]" value="0"/>
    </td>
    <td class="td-first">
      <input type="" name="submenu[]" placeholder="Sub Menu Name" class="form-control" required/>
    </td>
    <td class="td-second">
      <input type="" name="submenuroute[]" placeholder="Sub Menu Route" class="form-control" required/>
      <span class="text-danger text-sm d-none">Route name not exist in database</span>
    </td>
    <td><button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button></td>
  </tr>
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/plugins/select2/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('sweet-alert/sweetalert2.min.js')); ?>"></script>
<script>
  $(function(){
    $('.selectList').select2({
      theme: 'bootstrap4'
    })
    $('#selectIcon').select2({
      theme: 'bootstrap4',
      templateResult: formatState,
      templateSelection: formatState
    });
    $('.select2.select2-container').css('width','auto');
  })
  function checkinput(input)
  {
    if(input.val() == "")
    {
      $(input).css('border','1px solid red');
      return false;
    }
    else
    {
      $(input).css('border','1px solid #444951');
      return true;
    }
  }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/frontmenu/edit.blade.php ENDPATH**/ ?>