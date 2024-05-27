<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/toastr/toastr.min.css')); ?>">
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
                     <h3 class="card-title"><span><i class="fa-solid fa-location-dot"></i></span> City Core Areas</h3>
                     <button class="btn btn-success btn-sm float-right" id="addIp">
                        <i class="fa fa-plus"></i>
                        Add City Core Areas
                     </button>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="example1">
                           <thead>
                              <tr>
                                 <th>Serial#</th>
                                 <th>City Core Areas</th>
                                 <th>City Names</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $__currentLoopData = $coreAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($item->city_id == $item2->id): ?>
                              <tr>
                                 <td><?php echo e(++$key); ?></td>
                                 <td><?php echo e($item->name); ?></td>
                                 <td><?php echo e($item2->name); ?></td>
                                 <td><?php echo e($item->active == 1?'Active':'Deactive'); ?></td>
                                 <td>
                                    <button class="btn btn-primary btn-sm btnEditIP" data-value="<?php echo e($item->id); ?>"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm btnDeleteIP" data-value="<?php echo e($item->id); ?>"><i class="fa fa-trash"></i></button>
                                 </td>
                              </tr>
                              <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('admin.allowedip._modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/plugins/toastr/toastr.min.js')); ?>"></script>
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
   $(document).on('click', '#addIp', function() {
      $('#AllowedIpModel').modal('show').find('.modal-content').html(`<div class="modal-body">
         <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
         </div>`);
      id = $(this).attr('data-value');
      $.ajax({
         method: 'get',
         url: '/admin/coreareas/create',
         dataType: 'html',
         success: function(res) {
            $('#AllowedIpModel').find('.modal-content').html(res);
         }
      })
   })
   // $(document).on('submit', '#ipAddForm', function(e) {
   //    e.preventDefault();
   //    $.ajax({
   //       url: "<?php echo e(route('coreareas.store')); ?>",
   //       type: "POST",
   //       data: new FormData(document.forms.namedItem("ipAddForm")),
   //       contentType: false,
   //       cache: false,
   //       processData: false,
   //       dataType: 'JSON',
   //       beforeSend: function() {
   //          $('#loader-img').css('display', 'block');
   //       },
   //       success: function(res) {
   //          if ($.isEmptyObject(res.error)) {
   //             if (res.status == true) {
   //                window.location.reload();
   //             }
   //             if (res.unauthorized == true) {
   //                swal("Error!"  , "No Rights To Create Core Areas" , "error");
   //             }
   //          } else {
   //             printErrorMsg(res.error, '#AllowedIpError');
   //          }
   //       },
   //       error: function(jhxr, status, err) {
   //          console.log(jhxr);
   //       },
   //       complete: function() {
   //          $('#loader-img').css('display', 'none');
   //       }
   //    });
   // })
   $(document).on('submit', '#ipAddForm', function(e) {
      e.preventDefault();
      $.ajax({
         url: "<?php echo e(route('coreareas.store')); ?>",
         type: "POST",
         data: new FormData(document.forms.namedItem("ipAddForm")),
         contentType: false,
         cache: false,
         processData: false,
         dataType: 'JSON',
         beforeSend: function() {
            $('#loader-img').css('display', 'block');
         },
         success: function(res) {
            if ($.isEmptyObject(res.error)) {
               if (res.status == true) {
                  $('#AllowedIpSuccess').text('Core Area Added Successfully').show();
                  $('#AllowedIpError').hide();
                  setTimeout(function() {
                     $('#AllowedIpSuccess').hide();
                  }, 6500);
                  window.location.reload();
               }
               if (res.unauthorized == true) {
                  swal("Error!", "No Rights To Create Core Areas", "error");
               }
            } else {
               printErrorMsg(res.error, '#AllowedIpError');
            }
         },
         error: function(jhxr, status, err) {
            console.log(jhxr);
         },
         complete: function() {
            $('#loader-img').css('display', 'none');
         }
      });
   });
   //   delete button
   $(document).on('click', '.btnDeleteIP', function() {
      id = $(this).attr('data-value');
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
               url: '/admin/coreareas/' + id,
               method: 'DELETE',
               dataType: 'json',
               success: function(res) {
                  if (res.status == true) {
                     $(row).closest('tr').remove();
                     swal('Updated!', 'Core Area  deleted', 'success');
                     // console.log("delete record");
                  } 
                  if (res.unauthorized == true) {
                     swal("Error!"  , "No Rights To Delete Core Areas" , "error");
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
   //  end of delete button
   $(document).on('click', '.btnEditIP', function() {
      $('#AllowedIpModel').modal('show').find('.modal-content').html(`<div class="modal-body">
         <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
         </div>`);
      id = $(this).attr('data-value');
      $.ajax({
         method: 'get',
         url: '/admin/coreareas/' + id + '/edit',
         dataType: 'html',
         success: function(res) {
            $('#AllowedIpModel').find('.modal-content').html(res);
         },
         error: function(jhxr, status, err) {
            console.log(jhxr);
         },
         complete: function() {
            $('#loader-img').css('display', 'none');
         }
      })
   })
   $(document).on('submit', '#ipEditForm', function(e) {
      e.preventDefault();
      $.ajax({
         url: "<?php echo e(route('coreareas.update',1)); ?>",
         type: "PUT",
         data: $('#ipEditForm').serialize(),
         dataType: 'JSON',
         beforeSend: function() {
            $('#loader-img').css('display', 'block');
         },
         success: function(res) {
            if (res.unauthorized == true) {
               swal("Error!"  , "No Rights To Update Core Areas" , "error");
               return false ;
            }
            if ($.isEmptyObject(res.error)) {
               if (res.status) {
                  window.location.reload();
               }
            } else {
               printErrorMsg(res.error, '#EditAllowedIpError');
            }
         },
         error: function(jhxr, status, err) {
            console.log(jhxr);
         },
         complete: function() {
            $('#loader-img').css('display', 'none');
         }
      });
   })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/coreareas/index.blade.php ENDPATH**/ ?>