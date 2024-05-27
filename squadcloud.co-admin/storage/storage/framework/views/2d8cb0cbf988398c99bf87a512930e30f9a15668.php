
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
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0"><span><i class="fa-solid fa-circle-question"></i></span> Frequently Asked Questions (FAQ)</h3>
                            <div class="d-flex align-items-center ml-auto">
                                <a class="btn btn-success btn-sm mr-2" href="<?php echo e(route('front-faqs.create')); ?>">
                                    <i class="fa fa-plus"></i> Add Frequently Asked Questions (FAQ)
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Serial#</th>
                                            <th>Questions</th>
                                            <th>Answers</th>
                                            <th>Status</th>
                                            <th>In Order</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $frontfaq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$key); ?></td>
                                            <td><?php echo $item->question; ?></td>
                                            <td><?php echo $item->answer; ?></td>
                                            <td><?php echo e($item->active == 1?'active':'deactive'); ?></td>
                                            <td><?php echo e($item->faq_order); ?></td>
                                            <td class="d-flex g-2">
                                                <a class="btn btn-primary btn-sm mx-2" href="<?php echo e(route('front-faqs.edit',$item->id)); ?>"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm deleteRecord" data-id="<?php echo e($item->id); ?>"><i class="fa fa-trash"></i> </button>
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
    $(function() {
        $("#example1").DataTable({
            "responsive": true
        });
    });
    $(document).on('click', '#sortMenu', function() {
        $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
        </div>`);
        $.ajax({
            method: 'get',
            url: '<?php echo e(route("faqs.sort")); ?>',
            dataType: 'html',
            success: function(res) {
                console.log(res);
                $('#frontPagesModal').find('.modal-content').html(res);
                $('.todo-list').disableSelection();
                $('.todo-list').sortable({
                    placeholder: 'sort-highlight',
                    handle: '.handle',
                    forcePlaceholderSize: true,
                    zIndex: 999999,
                    update: function(event, ui) {
                        // console.log(ui.item);
                        $.ajax({
                            url: "/admin/front-faqs/sort",
                            type: "POST",
                            data: new FormData(document.forms.namedItem("faqSortForm")),
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: 'JSON',
                            success: function(res) {},
                            error: function(jhxr, status, err) {
                                console.log(jhxr);
                            },
                            complete: function() {
                            }
                        });
                    }
                });
            }
        })
    });
    //   delete 
    let deleteUrl = "<?php echo e(route('faq.destroy')); ?>";
    $(document).on('click', '.deleteRecord', function() {
        var id = $(this).data("id");
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
                    url: deleteUrl + '/' + id,
                    method: 'post',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            swal('Updated!', 'Front Faq deleted', 'success');
                            location.reload();
                        } 
                        if (res.unauthorized == true) {
                        swal('Error!', 'No rights To delete FAQ', 'error');
                        }   else {
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/front-faq/index.blade.php ENDPATH**/ ?>