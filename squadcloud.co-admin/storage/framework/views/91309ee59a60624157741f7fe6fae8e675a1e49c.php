<?php $__env->startSection('content'); ?>
<style>
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
  color: #fff;
    background-color: #007bff;
}
</style>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><i class="fa-solid fa-images"></i></span> Add Home (Slider)</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('homeslider.index')); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-slider-tab" data-toggle="tab" href="#nav-slider" role="tab" aria-controls="nav-home" aria-selected="true">Slider</a>
            <a class="nav-item nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false">Video</a>
          </div>
        </nav>
          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-slider" role="tabpanel" aria-labelledby="nav-slider-tab">
          <form action="<?php echo e(route('homeslider.store')); ?>" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Slide Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Example : Best Internet"  value="<?php echo e(old('title')); ?>">
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
                    <input type="text" class="form-control" name="slogan" placeholder="Example : One World One Connection" value="<?php echo e(old('slogan')); ?>">
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
                    <input type="text" class="form-control" name="image_alt" placeholder="Example : One World" value="<?php echo e(old('image_alt')); ?>">
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
                      <input type="checkbox"  <?php echo e(old('status') != null? 'checked' :'unchecked'); ?> name="status" id="checkboxSuccess1">
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
          <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
          <form action="<?php echo e(route('homeslider.store')); ?>" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Slide Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Example : Best Internet"  value="<?php echo e(old('title')); ?>">
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
                    <?php if(isset($data)): ?>
                    <video controls width="200" class="mt-3 mb-3">
                      <source src="<?php echo e(asset('HomeVideo/' . $data->video )); ?>" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    <input type="file" class="form-control-file" name="video" id="video">
                    <?php $__errorArgs = ['video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger mt-2 mb-0 text-sm"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php else: ?>
                    <input type="file" class="form-control-file" name="video" id="video">
                    <?php $__errorArgs = ['video'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger mt-2 mb-0 text-sm"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <label for="" style="visibility: hidden">A</label>
                    <div class="icheck-success d-block">
                      <input type="checkbox"  <?php echo e(old('status') != null? 'checked' :'unchecked'); ?> name="status" id="checkboxSuccess2">
                      <label for="checkboxSuccess2">
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
          </form>         </div>
        </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scr  ipts'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/homeslider/create.blade.php ENDPATH**/ ?>