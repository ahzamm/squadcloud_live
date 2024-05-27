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
      <?php if($message = Session::get('success')): ?>
      <div class="alert alert-success alert-block">
       <button type="button" class="close" data-dismiss="alert">×</button>  
       <strong><?php echo e($message); ?></strong>
     </div>
     <?php endif; ?>
     <?php if($message = Session::get('error')): ?>
     <div class="alert alert-danger alert-block">
       <button type="button" class="close" data-dismiss="alert">×</button>  
       <strong><?php echo e($message); ?></strong>
     </div>
     <?php endif; ?>
     <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title"><span><i class="fa-solid fa-images"></i></span> Home (Slider)</h3>
            <a class="btn btn-success btn-sm float-right" href="<?php echo e(route('homeslider.create')); ?>"><i
              class="fa fa-plus"></i> Add Home Slider
            </a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="example1" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Serial#</th>
                    <th>Slide Title</th>
                    <th>Slide Slogan</th>
                    <th>Slide Image / Video</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="sliderSorter" class="move">
                  <input type="hidden" class="csrf_token" value="<?php echo e(csrf_token()); ?>">
                  <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e(++$key); ?> <input type="hidden" class="order-id" value="<?php echo e($item->id); ?>"></td>
                    <td><?php echo e($item->title); ?></td>
                    <td><?php echo e($item->slogan); ?></td>
                    <?php if($item->image): ?>
                    <td>
                      <img src="<?php echo e(asset('homeslider/' . $item->image)); ?>" height="60"
                      width="120" alt="" srcset="">
                    </td>
                    <?php else: ?>
                    <td>
                      <video controls width="200" height="120">
                        <source src="<?php echo e(asset('VideoHeader/' . $item->video)); ?>" type="video/mp4">
                          Your browser does not support the video tag.
                        </video>
                      </td>
                      <?php endif; ?>
                      <td><?php echo e($item->active == 1 ? 'Active' : 'In-active'); ?></td>
                      <td class="d-flex justify-content-center" style="gap: 5px;">
                        <button class="btn btn-success btn-sm viewFrontPages" data-value="<?php echo e($item->id); ?>"><i class="fa fa-eye"></i></button>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('edit.slider', $item->id)); ?>"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="<?php echo e($item->id); ?>"><i class="fa fa-trash"></i></button>
                      </td>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    id = $(this).attr('data-value');
    $.ajax({
      method: 'get',
      url: '/admin/homeslider/' + id,
      dataType: 'html',
      success: function(res) {
        $('#frontPagesModal').find('.modal-content').html(res);
      }
    })
  }) ;
        //  Slider Sorting
        let sliderSortTable = $('#sliderSorter');
        let csrfToken       = $('.csrf_token');
        let slidereditUrl   = "<?php echo e(route('edit.slider')); ?>";
        let sortMenuUrl = "<?php echo e(route('sort.slider.image')); ?>";
        let baseUrl     = "<?php echo e(asset('')); ?>";
        $(sliderSortTable).sortable({
         update : function( event , ui ){
          var SortIds = $(this).find('.order-id').map(function(){
           return $(this).val().trim();
         }).get();
      // Getting The Order id of each sortIds
      $(this).find('.order-id').each(function(index){
       $(this).text(SortIds[index]);
     });
      //Sending Ajax to update the sort ids and change the data sorting
      $.ajax({
       url : sortMenuUrl ,
       type:"post" ,
       data: {sort_Ids : SortIds} ,
       headers : {
        "X-CSRF-TOKEN": csrfToken.val()
      },
      success:function(response){
        let table = "" ;
        $(response).each(function(index , value){
         table +=` <tr>
         <td>${index + 1} <input type="hidden" class="order-id" value="${value.id}"></td>
         <td>${value.title}</td>
         <td>${value.slogan}</td>
         <td><img src="${baseUrl}homeslider/${value.image}" height="60"
         width="120" alt="" srcset=""></td>
         <td>${value.active == 1 ? 'Active' : 'In-active' }</td>
         <td>
         <button class="btn btn-success btn-sm viewFrontPages"
         data-value="${value.id}"><i class="fa fa-eye"></i></button>
         <a class="btn btn-primary btn-sm"
         href="${slidereditUrl}/${value.id}"><i
         class="fa fa-edit"></i></a>
         <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="${value.id}"><i
         class="fa fa-trash"></i> </button>
         </td>
         </tr>`;
       });
        $(sliderSortTable).html(table);
      }
    })
    }
  }
  );
        $(document).ready(function(){
          let urlDeleteSlider = "<?php echo e(route('destroy.slider')); ?>" ;
          $(document).on('click' , '.btnDeleteMenu' , function(){
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
          }).then( function(result) {
            if (result.value) {
             $.ajax({
              url:urlDeleteSlider +"/"+ menuId,
              method:'post',
              dataType:'json',
              success:function(res){
                if(res.unauthorized){
                  swal('Error!', 'No rights To Delete Home Slides', 'error');
                }
                if(res.status)
                {
                  $(row).parents('tr').remove();
                  swal('Updated!', 'Home Slider deleted', 'success');
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
        })
      </script>
      <?php $__env->stopPush(); ?>
      <!-- Code Finalize -->
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/homeslider/index.blade.php ENDPATH**/ ?>