
<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('site/sweet-alert/sweetalert2.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<style>
  /* The switch - the box around the slider */
  .switch {
    position: relative;
    display: inline-block;
    width: 55px;
    height: 27px;
  }
  /* Hide default HTML checkbox */
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }
  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }
  .slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }
  input:checked+.slider {
    background-color: green;
  }
  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }
  input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }
  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }
  .slider.round:before {
    border-radius: 50%;
  }
</style>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-users"></i></span> Management Users</h3>
              <div class="ml-auto">
                <a href="<?php echo e(route('user.create')); ?>" class="btn btn-success btn-sm">
                  <i class="fa fa-plus"></i> Add New Users
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>User Name</th>
                      <th>Full Name</th>
                      <th>Email Address</th>
                      <th>Contact Number</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $data['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($loop->iteration); ?></td>
                      <td><?php echo e($item->name); ?></td>
                      <td><?php echo e($item->first_name); ?> &nbsp; <?php echo e($item->last_name); ?></td>
                      <td><?php echo e($item->email); ?></td>
                      <td><?php echo e($item->phone); ?></td>
                      <td>
                        <label class="switch">
                          <input type="checkbox" class="status_check" <?php if($item->active == 1): ?> checked <?php endif; ?> data-user-id="<?php echo e($item->id); ?>">
                          <span class="slider round"></span>
                        </label>
                      </td>
                      <td>
                        <a href="<?php echo e(route('user.menu.access' , $item->id)); ?>" title="Give Access" class="btn btn-sm btn-info"><i class="fa fa-unlock"></i></a>
                        <a href="<?php echo e(route('user.edit'  , $item->id)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></a>
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

<div class="modal fade" id="modalShowAccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modify Member Access</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalBody">
        <div class="p-2 d-flex justify-content-center">
          <div class="sk-wave text-center">
            <div class="sk-rect sk-rect1"></div>
            <div class="sk-rect sk-rect2"></div>
            <div class="sk-rect sk-rect3"></div>
            <div class="sk-rect sk-rect4"></div>
            <div class="sk-rect sk-rect5"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
    let changeStatusUrl = "<?php echo e(route('user.status.change')); ?>";
    // Changing Status
    $(".status_check").on('change', function(e) {
      let currentStatus = "";
      if ($(this).prop('checked') == true) {
        currentStatus = 1;
        $(this).closest('tr').find('.status').text('active');
      } else {
        currentStatus = 0;
        $(this).closest('tr').find('.status').text('deactive');
      }
      var status = $(this);
      e.preventDefault();
      $.ajax({
        url: changeStatusUrl,
        type: "Post",
        data: {
          id: $(this).attr("data-user-id"),
          status: currentStatus
        },
        success: function(response) {
          if (response == "unauthorized") {
            e.preventDefault();
            swal("Error!", "Status Not Changed , Because You have No Rights To change status", "error");
            status.prop('checked', false);
          }
          if (response == "success") {
            swal({
              title: 'Status Changed!',
              text: "User Status Has been Changed!",
              animation: false,
              customClass: 'animated pulse',
              type: 'success',
            });
          }
        }
      })
    })
    // Delete Script
    let deleteUrl = "<?php echo e(route('user.destroy')); ?>";
    $(document).on('click', '.btnDeleteMenu', function() {
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
              if (res.unauthorized) {
                swal("Error!", "No Rights To Delete Users", "error");
              }
              if (res.status) {
                $(row).parents('tr').remove();
                swal('Deleted!', 'User Has been deleted', 'success');
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
    //delete menu end
  });
  $(document).on('click', '.btnShowAccessModal', function() {
    $('#modalShowAccess').modal('show');
    id = $(this).attr('data-value');
    $.ajax({
      type: 'GET',
      url: '/admin/useraccess/show/' + id,
      dataType: 'html',
      beforeSend: function() {
        $('#modalBody').html(`<div class="p-2 d-flex justify-content-center">
          <div class="sk-wave text-center">
          <div class="sk-rect sk-rect1"></div>
          <div class="sk-rect sk-rect2"></div>
          <div class="sk-rect sk-rect3"></div>
          <div class="sk-rect sk-rect4"></div>
          <div class="sk-rect sk-rect5"></div>
          </div>
          </div>`);
      },
      success: function(res) {
        $('#modalBody').html(res);
      },
      error: function(jhxr, status, err) {
        console.log(jhxr);
      },
      complete: function() {
      }
    })
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/users/index.blade.php ENDPATH**/ ?>