<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 
 <?php $__env->startPush('style'); ?>
 <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('site/sweet-alert/sweetalert2.css')); ?>">
 <?php $__env->stopPush(); ?>
 <?php $__env->startSection('content'); ?>
 <style>
   .move {
    cursor: move;
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
              <h3 class="card-title mb-0"><span><i class="fa-brands fa-twitter"></i></span> Social Links</h3>
              <div class="ml-auto">
                <a href="<?php echo e(route('social.create')); ?>" class="btn btn-success btn-sm">
                  <i class="fa fa-plus"></i> Add Social Media
                </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
              <div class="table-responsive ">
                <table class="table table-bordered table-striped" id="">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>Social Media Names</th>
                      <th>Social Media Icons</th>
                      <th>Social Media Links</th>
                      <th>Icon Colors</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="sortfrontMenu" class="move">
                    <?php $__currentLoopData = $socials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($key+1); ?>

                        <input type="hidden" class="order-id" value="<?php echo e($item->id); ?>">
                      </td>
                      <td><?php echo e($item->name); ?></td>
                      <td><i class="<?php echo e($item->icon); ?>"></i></td>
                      <td><?php echo e($item->url); ?></td>
                      <td><center><button class="rounded" disabled style="width: 50px; height:20px; background-color:<?php echo e($item->color); ?>;box-shadow:0 0 10px grey ; border:none"></button></center></td>
                      <td><?php echo e($item->status == 1 ? 'active':'deactive'); ?></td>
                      <td>
                        <a href="<?php echo e(route('social.edit',$item->id )); ?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></a>
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
        let deleteUrl = "<?php echo e(route('social.destroy')); ?>";
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
                              else if(res.status == "no Access"){
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
    // Sorting Data
    let sortTable = $("#sortfrontMenu");
    let sortingFrontUrl = "<?php echo e(route('sort.social')); ?>";
    let csrfToken = $(".csrf_token");
    var editUrlFront = "<?php echo e(route('social.edit')); ?>";
    $(sortTable).sortable({
      update: function(event, ui) {
       var SortIds = $(this).find('.order-id').map(function() {
        return $(this).val().trim();
      }).get();
         // Getting The Order id of each sortIds
         $(this).find('.order-id').each(function(index) {
          $(this).text(SortIds[index]);
        });
         //Sending Ajax to update the sort ids and change the data sorting
         $.ajax({
          url: sortingFrontUrl,
          type: "post",
          data: {
           sort_Ids: SortIds
         },
         headers: {
           "X-CSRF-TOKEN": csrfToken.val()
         },
         success: function(response) {
           let table = "";
           $(response).each(function(index, value) {
            table += ` <tr>
            <td>${index + 1 }
            <input type="hidden" class="order-id" value="${value.id}">
            </td>
            <td >${value.name}</td>
            <td>${value.icon}</td>
            <td>${value.url}</td>
            <td>${value.color}</td>
            <td>${value.status}</td>
            <td>
            <a href="` + editUrlFront + "/" + value.id + `" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger btn-sm deleteRecord" data-id="${value.id}">
            <i class="fa fa-trash"></i> </button>
            </td>
            </tr>`;
          });
           $(sortTable).html(table);
         }
       })
       }
     });
   </script>
   <?php $__env->stopPush(); ?>
<!-- Code Finalize -->
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/social/index.blade.php ENDPATH**/ ?>