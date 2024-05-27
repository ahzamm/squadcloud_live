<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-pencil"></i></span> Add About Us</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('aboutus.index')); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="<?php echo e(route('aboutus.store')); ?>" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description">Description <span style="color: red">*</span></label>
                    <textarea class="form-control summernote" name="description" value="<?php echo e(old('description')); ?>" id="summernote" placeholder="Description add here."></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger mt-2 mb-0 text-sm"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Upload Image <span style="color: red">*</span></label>
                    <table class="table table-bordered" id="dynamicTable"> 
                      <tr><td colspan="2">
                        <input type="file" class="form-control-file" name="images[]" id="image-about"></td>
                        <td colspan="3">
                          <button type="button" name="addmore[0][add]" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                        </td>
                      </tr>
                    </table>
                    <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger mt-2 mb-0 text-sm"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                  </div></div>                 
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
  <script type="text/javascript">
    var i = 0;
    $("#add").click(function(){
      ++i;
      $html = '<tr><td colspan="3"><input type="file" name="images[]" class="" /></td><td colspan="2"><button type="button" class="btn btn-danger remove-tr ml-1">X</button></td></tr>';
      $("#dynamicTable").append($html);
    });
    $(document).on('click', '.remove-tr', function(){  
     $(this).parents('tr').remove();
   });  
 </script>
 <?php if(Session::has("success")): ?>
 <script>
  swal({
    title: 'Success!',
    text: "<?php echo e(Session::get('success')); ?>",
    animation: false,
    customClass: 'animated pulse',
    type: 'success',   
  });
</script>
<?php endif; ?>
<?php if(Session::has("error")): ?>
<script>
  swal({
    title: 'Error!',
    text: '<?php echo e(Session::get("error")); ?>',
    animation: false,
    customClass: 'animated pulse',
    type: 'error',
  });
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/about-us/create.blade.php ENDPATH**/ ?>