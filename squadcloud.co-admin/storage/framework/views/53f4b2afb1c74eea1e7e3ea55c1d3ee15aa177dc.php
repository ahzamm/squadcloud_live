
<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-circle-question"></i></span> Add Frequently Ask Question (FAQ)</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('front-faqs.index')); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="<?php echo e(route('front-faqs.store')); ?>" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Question <span style="color: red">*</span></label>
                    <textarea name="question" rows="4" placeholder="Example : How are you" required class="form-control summernote"></textarea>
                    <?php $__errorArgs = ['question'];
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
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Answer <span style="color: red">*</span></label>
                    <textarea name="answer" id="summernote" placeholder="Example : I am fine" required class="form-control summernote"></textarea>
                    <?php $__errorArgs = ['answer'];
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
                <div class="col-md-6">
                  <label for="">Is Active <span style="color: red">*</span></label>
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" checked name="active" id="checkboxSuccess1">
                      <label for="checkboxSuccess1">
                        Status (On & Off)
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-outline-primary float-right"><i class=""></i>Submit</button>
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
<script src="<?php echo e(asset('admin/plugins/select2/js/select2.full.min.js')); ?>"></script>
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
  })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/front-faq/create.blade.php ENDPATH**/ ?>