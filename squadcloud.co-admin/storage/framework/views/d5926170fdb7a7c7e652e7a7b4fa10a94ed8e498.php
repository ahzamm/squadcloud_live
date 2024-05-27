
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

input:checked + .slider {
  background-color: green;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
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
                            <h3 class="card-title mb-0"><span><i class="fa-solid fa-user-shield"></i></span> Manage User Access</h3>
                            <div class="ml-auto">
                                <a href="<?php echo e(route('user.index')); ?>" class="btn btn-outline-secondary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="table-responsive ">
                                <table class="table table-bordered table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th>Grant Access (All)</th>
                                            <th>Serial#</th>
                                            <th>Menus</th>
                                            <th>Sub Menus</th>
                                            <th>View Access</th>
                                            <th>Create Access</th>
                                            <th>Modify Access</th>
                                            <th>Remove Access</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data['submenus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>  <td>
                                            <label class="switch">
                                            <input type="checkbox" <?php if( $item->create_status == 1 && $item->view_status == 1 && $item->update_status == 1 && $item->delete_status == 1  ): ?> checked <?php endif; ?>  class="status_check"  title="all">
                                            <span class="slider round"></span>
                                            </label>
                                            </td>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <input type="hidden" class="menuId" value="<?php echo e($item->id); ?>" >
                                            <td><?php echo e($item->submenu->menu->menu); ?></td>
                                            <td><?php echo e($item->submenu->submenu); ?></td>
                                            <td>
                                            <label class="switch">
                                            <input type="checkbox" <?php if($item->view_status == 1): ?> checked <?php endif; ?> class="status_check"  title="view">
                                            <span class="slider round"></span>
                                            </label>
                                            </td>
                                            <td>
                                            <label class="switch">
                                            <input type="checkbox" <?php if($item->create_status == 1): ?> checked <?php endif; ?>  class="status_check"  title="create">
                                            <span class="slider round"></span>
                                            </label>
                                            </td>
                                            <td>
                                            <label class="switch">
                                            <input type="checkbox" <?php if($item->update_status == 1): ?> checked <?php endif; ?>  class="status_check" title="update">
                                            <span class="slider round"></span>
                                            </label> 
                                            </td>
                                            <td>
                                            <label class="switch">
                                            <input type="checkbox" <?php if($item->delete_status == 1): ?> checked <?php endif; ?>  class="status_check"  title="delete">
                                            <span class="slider round"></span>
                                            </label> 
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
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
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
        // Menu  Access Function
        
        // End of Menu Access Function
        $('#example').DataTable();
        let menuAccessUrl  = "<?php echo e(route('menu.give.access')); ?>";
        $(document).on('change', '.status_check', function (e) {
            let currentRow = $(this).closest("tr");
            let view = currentRow.find('.status_check[title="view"]').prop("checked") ? 1 : 0;
            let create = currentRow.find('.status_check[title="create"]').prop("checked") ? 1 : 0;
            let update = currentRow.find('.status_check[title="update"]').prop("checked") ? 1 : 0;
            let delete_val = currentRow.find('.status_check[title="delete"]').prop("checked") ? 1 : 0;
            let changedCheckbox = $(this);

            if (changedCheckbox.attr("title") == "view") {
            e.preventDefault();
            view = changedCheckbox.prop("checked") ? 1 : 0;
            }
            if (changedCheckbox.attr("title") == "all") {
                e.preventDefault();
                let checkAll = changedCheckbox.prop("checked");
                currentRow.find('.status_check').not('[title="all"]').prop("checked", checkAll);
                view = create = update = delete_val = checkAll ? 1 : 0;
            }
            if (changedCheckbox.attr("title") == "create") {
            e.preventDefault();
            create = changedCheckbox.prop("checked") ? 1 : 0;
            }
            if (changedCheckbox.attr("title") == "update") {
            e.preventDefault();
            update = changedCheckbox.prop("checked") ? 1 : 0;
            }
            if (changedCheckbox.attr("title") == "delete") {
            e.preventDefault();
            delete_val = changedCheckbox.prop("checked") ? 1 : 0;
            }
            let menuId = currentRow.find('.menuId').val();
    $.ajax({
        url: menuAccessUrl + '/' + menuId,
        type: "Post",
        data: {
            view_id: view, update_id: update, delete_id: delete_val, create_id: create
        },
        success: (response) => {
            if (response.status == true) {
                swal({
                    title: 'Access Status Changed!',
                    text: "User Access Status Has been Changed!",
                    animation: false,
                    customClass: 'animated pulse',
                    type: 'success',
                });
            } else {
                swal({
                    title: 'Error occurred!',
                    text: "Failed to Change User Access Status!",
                    animation: false,
                    customClass: 'animated pulse',
                    type: 'error',
                });
            }
         }
     });
  });     
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/users/manuaccess.blade.php ENDPATH**/ ?>