<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0"><span><i class="fa-solid fa-venus"></i></span> Update Why ChooseUs</h3>
                        <div class="ml-auto">
                            <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('whychoose.index')); ?>">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    <form action="<?php echo e(route('whychoose.update',$edit_whyChooseUs->id)); ?>" method="POST" enctype="multipart/form-data">
                        <div class="card-body pad">
                            <?php echo method_field('PUT'); ?>
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="title" placeholder="Example : Best Broadband Service In Pakistan" required value="<?php echo e($edit_whyChooseUs->title); ?>">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description <span style="color: red">*</span></label>
                                        <textarea class="form-control summernote" name="description" rows="4" placeholder="Description add here...."><?php echo e($edit_whyChooseUs->description); ?></textarea>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Upload Image <span style="color: red">*</span></label>
                                        <input type="file" class="form-control-file mt-2" name="image">
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
                                        <label for="" style="visibility: hidden">A</label>
                                        <div class="icheck-success d-block">
                                            <input type="checkbox" <?php if($edit_whyChooseUs->active == 1): ?> checked <?php endif; ?> name="status" id="checkboxSuccess1" value="1">
                                            <label for="checkboxSuccess1">Status (On & Off) <span style="color: red">*</span></label>
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/WhyChooseUs/edit.blade.php ENDPATH**/ ?>