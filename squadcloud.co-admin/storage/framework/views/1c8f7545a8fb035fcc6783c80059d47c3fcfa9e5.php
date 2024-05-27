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
            <div class="card-header">
              <h3 class="card-title"><span><i class="fa-solid fa-copyright"></i></span> Brand (Logo)</h3>
              <a class="btn btn-success btn-sm float-right" href="<?php echo e(route('logo.create')); ?>"><i class="fa fa-plus"></i> Add Brand logo</a>
            </div>
            <!-- /.card-header -->
            <span class="success-delete"></span>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>Logo Image (large size)</th>
                      <th>Logo Image (Small Size)</th>
                      <th>Brand Name</th>
                      <th>Site Footer </th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e(++$key); ?></td>
                      <td><img src="<?php echo e(asset('front-logo/'.$item->image)); ?>" height="60" width="120" alt="" srcset=""></td>
                      <td><img src="<?php echo e(asset('small-front-logo/'.$item->small_image)); ?>" height="60" width="120" alt="" srcset=""></td>
                      <td><?php echo e($item->title); ?></td>
                      <td><?php echo e($item->footer); ?></td>
                      <td><?php echo e($item->active == 1 ? 'Active' : 'In-active'); ?></td>
                      <td>
                        
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('logo.edit', $item->id)); ?>"><i class="fa fa-edit"></i></a>
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
            //   "autoWidth": false,
          });
  });
  $(document).on('click', '.viewFrontPages', function() {
    $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
      <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
      </div>`);
    logo = $(this).attr('data-value');
    $.ajax({
      method: 'get',
      url: '/admin/logo/' + logo,
      dataType: 'html',
      success: function(res) {
        $('#frontPagesModal').find('.modal-content').html(res);
      }
    })
  })
</script>
<script type="text/javascript">
  $(document).on('click' , '.deleteRecord' , function(){
   var logo = $(this).data("id");
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
  }).then( function(result) {
    if (result.value) {
     $.ajax({
      url:'/admin/logo/' + logo,
      method:'DELETE',
      dataType:'json',
      data : {
       "frontmenu": logo,
       "_token": token,
     },
     success:function(res){
      if(res.unauthorized){
        swal('Error!', 'No Rights To delete Front Logo', 'error');
      }
      if(res.status)
      {
        $(row).parents('tr').remove();
        swal('Updated!', 'Front Logo deleted', 'success');
                              // console.log("delete record");
                            }
                            else
                            {
                              //$(secondInput).siblings('span').removeClass('d-none');
                            }
                          },
                          error:function(jhxr,status,err){
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/front-logo/index.blade.php ENDPATH**/ ?>