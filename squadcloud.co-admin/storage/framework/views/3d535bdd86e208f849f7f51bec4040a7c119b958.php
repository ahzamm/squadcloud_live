<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('site/sweet-alert/sweetalert2.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0"><span><i class="fa-solid fa-venus"></i></span> Why ChooseUs</h3>
                            <a href="<?php echo e(route('whychoose.create')); ?>" class="btn btn-success btn-sm ml-auto">
                                <i class="fa fa-plus"></i> Add Why ChooseUs
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table class="table table-bordered table-striped" id="example1" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Serial#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $whyChooseUs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$key); ?></td>
                                            <td><?php echo e($item->title); ?></td>
                                            <td><?php echo $item->description; ?></td>
                                            <td><img src="<?php echo e(asset('whychoose-us/'.$item->image)); ?>" height="60" width="60" alt="" srcset=""></td>
                                            <td><?php echo e($item->active == 1 ? 'Active' : 'In-active'); ?></td>
                                            <td>
                                                <button class="btn btn-success btn-sm viewFrontPages" data-value="<?php echo e($item->id); ?>"><i class="fa fa-eye"></i>
                                                </button>
                                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('whychoose.edit', $item->id)); ?>"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm deleteRecord" data-id="<?php echo e($item->id); ?>"><i class="fa fa-trash"></i>
                                                </button>
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
        $("#example1").DataTable({
            "responsive": true
        });
    });
    $(document).on('click', '.viewFrontPages', function() {
        $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
            </div>`);
        id = $(this).attr('data-value');
        $.ajax({
            method: 'get',
            url: '/admin/whychoose/' + id,
            dataType: 'html',
            success: function(res) {
                $('#frontPagesModal').find('.modal-content').html(res);
            }
        })
    })
</script>
<script type="text/javascript">
    $(document).on('click', '.deleteRecord', function() {
        var whychoose = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
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
                    url: '/admin/whychoose/' + whychoose,
                    method: 'DELETE',
                    dataType: 'json',
                    data: {
                        "whychoose": whychoose,
                        "_token": token,
                    },
                    success: function(res) {
                        if(res.unauthorized){
                            swal("Error!" , "No Rights To Delete Why choose Us Informations" , "error");
                        }
                        if (res.status) {
                            $(row).parents('tr').remove();
                            swal('Updated!', 'Why Choose Us deleted', 'success');
                            // console.log("delete record");
                        } else {
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
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/WhyChooseUs/index.blade.php ENDPATH**/ ?>