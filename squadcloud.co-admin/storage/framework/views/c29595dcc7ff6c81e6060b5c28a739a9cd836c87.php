
<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('site/sweet-alert/sweetalert2.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0"><span><i class="fa-solid fa-address-card"></i></span> Contact Us</h3>
                            <div class="ml-auto">
                                <a href="<?php echo e(route('homeside.create')); ?>" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Add Contact Us
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="table-responsive ">
                                <table class="table table-bordered table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th>Serial#</th>
                                            <th>Email Address</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data['homeside']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($item->email); ?></td>
                                            <td><?php echo e($item->phone); ?></td>
                                            <td><?php echo e($item->address); ?></td>
                                            <td><?php echo e($item->status == 1 ? 'active':'deactive'); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('homeside.edit',$item->id )); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></a>
                                                <a class="btn btn-danger btn-sm btnDeleteMenu text-white" data-value="<?php echo e($item->id); ?>"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php echo $__env->make('admin.front-faq._modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/sweet-alert/sweetalert2.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        // Delete Script
        let deleteUrl = "<?php echo e(route('homeside.destroy')); ?>";
        $('.btnDeleteMenu').click(function() {
            menuId = $(this).attr('data-value');
            row = $(this);
            swal({
                title: 'Are you sure?',
                text: "You want to delete this record",
                animation: false,
                customClass: 'animated pulse',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true,
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: deleteUrl + '/' + menuId,
                        method: 'get',
                        dataType: 'json',
                        success: function(res) {
                            if (res.status == true) {
                                $(row).parents('tr').remove();
                                swal('Updated!', 'Social Link Has been deleted', 'success');
                                // console.log("delete record");
                            } 
                            else if(res.unauthorized == true){
                                swal('Error!', 'You have no access to delete social links', 'error');
                            }
                            else {
                                //$(secondInput).siblings('span').removeClass('d-none');
                            }
                        },
                        error: function(jhxr, status, err) {
                            console.log(jhxr);
                        }
                    })
                } else if (result.dismiss === 'cancel') {
                    //  swal(
                    //      'Cancelled',
                    //      'Your imaginary data is safe :)',
                    //      'error'
                    //  )
                }
            })
        })
        //delete menu end
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/Homesidemenu/index.blade.php ENDPATH**/ ?>