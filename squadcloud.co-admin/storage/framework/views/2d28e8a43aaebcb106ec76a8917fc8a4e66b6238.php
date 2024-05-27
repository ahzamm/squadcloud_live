<?php $__env->startSection('content'); ?>

<div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

        <div class="row">

          <div class="col-md-12">

            <div class="card card-outline card-info mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-copyright"></i></span> Update Brand (Logo & Footer)</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('logo.index')); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
              <form action="<?php echo e(route('logo.update',$logo_edit->id)); ?>" method="POST" enctype="multipart/form-data">

              <div class="card-body pad">

              <?php echo method_field('PUT'); ?>               

<?php echo csrf_field(); ?>


<div class="row">

  <div class="col-md-6">

    <div class="form-group">
    
      <label for="">Upload Brand Logo (Large Size) <span style="color: red">*</span></label>
    
      <img src="<?php echo e(asset('front-logo/'.$logo_edit->image)); ?>" height="60"
      width="120" alt="" srcset="" >
     <input type="file" class="form-control-file" name="image" id="image">
    
      <?php $__errorArgs = ['image'];
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
    
    <div class="form-group">
    
      <label for="">Upload Brand Logo (Small Size) <span style="color: red">*</span></label>
    
      <img src="<?php echo e(asset('small-front-logo/'.$logo_edit->small_image)); ?>" height="60"
      width="120" alt="" srcset="" >
      <input type="file" class="form-control-file" name="smallLogo" id="smallLogo">
    
      <?php $__errorArgs = ['smallLogo'];
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
    
    <div class="form-group">
    
      <label for="">Website Title </label>
    
     
      <input type="text" class="form-control"  name="title" value="<?php echo e($logo_edit->title); ?>" id="title" placeholder="Example : Blink Broadband" required>
    
      <?php $__errorArgs = ['title'];
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
    
    <div class="form-group">
    
      <label for="">Website Footer </label>
    
     
      <input type="text" class="form-control" value="<?php echo e($logo_edit->footer); ?>"  name="footer" id="title" placeholder="Example : Powerd By SquadCloud" required>
    
      <?php $__errorArgs = ['footer'];
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

<div class="col-md-2">

<div class="form-group clearfix">

  <label for="" style="visibility: hidden">A</label>

    <div class="icheck-success d-block">
     
     
    <input type="checkbox"  <?php echo e($logo_edit->active == 1 ? 'checked' : 'unchecked'); ?> name="status" id="checkboxSuccess1">

      <label for="checkboxSuccess1">

          Status (On & Off)

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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/front-logo/edit.blade.php ENDPATH**/ ?>