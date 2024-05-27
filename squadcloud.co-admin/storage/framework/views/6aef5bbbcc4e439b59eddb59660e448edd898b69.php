
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Package</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('packages.index')); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
              <form action="<?php echo e(route('packages.update',$package->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo method_field('PUT'); ?>
              <!-- /.card-header -->
              <div class="card-body pad">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="">Internet Package Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="package_name"  value="<?php echo e(old('package_name') == NULL?$package->name:old('package_name')); ?>">
                          <?php $__errorArgs = ['package_name'];
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
                        <label for="">Internet Bandwidth (Mbps) <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="mbps"  value="<?php echo e(old('mbps') == NULL?$package->limit:old('mbps')); ?>">
                        <?php $__errorArgs = ['mbps'];
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
                      <label for="">Internet Packages Color Codes <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="color"  value="<?php echo e(old('color') == NULL?$package->color:old('color')); ?>">
                      <?php $__errorArgs = ['color'];
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
                        <label for="">Select Province <span style="color: red">*</span></label>
                        <select class="form-control" name="province">
                          <option value=>--Select Province--</option>
                          <?php
                            $province = ["sindh","punjab","balochistan","kpk"];   
                          ?>
                          <?php $__currentLoopData = $province; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($item); ?>" <?php echo e(old('province') == $item?'selected':($package->province == $item? 'selected':'' )); ?>><?php echo e(ucwords($item)); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['province'];
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
                            <label for="">Upload Internet Package Image <span style="color: red">*</span></label> <br>
                          <input type="file" value="<?php echo e($package->package_slider_img); ?>" name="package_slider_img">
                            <?php $__errorArgs = ['package_slider_img'];
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
                            <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                  <input type="checkbox"  <?php echo e($package->active == 1? 'checked' :'unchecked'); ?> name="status" id="checkboxSuccess1">
                                  <label for="checkboxSuccess1">
                                      Status (On & Off)
                                  </label>
                                </div>
                              </div>
                        </div>
                       
                    </div>

                 
                
                
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary float-right">Update</button>
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
<script>
    $(document).ready(function(){
        $('#pageContent').summernote({
          height:300
        });
        
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/packages/edit.blade.php ENDPATH**/ ?>