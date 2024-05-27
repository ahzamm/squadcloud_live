<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><i class="fa-solid fa-images"></i></span> Update Home (Slider)</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('homeslider.index')); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <?php if($homeslider->image): ?>
          <form action="<?php echo e(route('homeslider.update',$homeslider->id)); ?>" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              <?php echo method_field('PUT'); ?>
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Slide Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Example : Best Internet" required value="<?php echo e($homeslider->title); ?>">
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
                    <label for="">Slide Slogan <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="slogan" placeholder="Example : One World One Connection" required value="<?php echo e($homeslider->slogan); ?>">
                    <?php $__errorArgs = ['slogan'];
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
                    <label for="">Image Alt <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="image_alt" placeholder="Example : One World" value="<?php echo e($homeslider->image_alt); ?>">
                    <?php $__errorArgs = ['image_alt'];
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
                    <label for="">Upload Slider Image (Size W/H: 1903x720) <span style="color: red">*</span></label>
                    <input type="file" class="form-control-file" name="banner_image" >
                    <?php $__errorArgs = ['banner_image'];
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
                    <label for="" style="visibility: hidden">A</label>
                    <div class="icheck-success d-block">
                      <input type="checkbox"  <?php echo e($homeslider->active == 1? 'checked' :'unchecked'); ?> name="status" id="checkboxSuccess1">
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
          <?php else: ?>
          <form action="<?php echo e(route('homeslider.update',$homeslider->id)); ?>" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              <?php echo method_field('PUT'); ?>
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Slide Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Example : Best Internet" required value="<?php echo e($homeslider->title); ?>">
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
                    <label for="">Upload Video <span style="color: red">*</span></label> <br>
                    <?php if(isset($homeslider)): ?>
                    <video controls width="200" class="mt-3 mb-3">
                      <source src="<?php echo e(asset('VideoHeader/' . $homeslider->video )); ?>" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    <input type="file" class="form-control-file" name="video" id="video">
                    <?php else: ?>
                    <input type="file" class="form-control-file" name="video" id="video">
                    <?php endif; ?>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <label for="" style="visibility: hidden">A</label>
                    <div class="icheck-success d-block">
                      <input type="checkbox"  <?php echo e($homeslider->active == 1? 'checked' :'unchecked'); ?> name="status" id="checkboxSuccess2">
                      <label for="checkboxSuccess2">
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
          <?php endif; ?>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/homeslider/edit.blade.php ENDPATH**/ ?>