<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('site/sweet-alert/sweetalert2.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','All Menus'); ?>
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
                  <div class="card-header">
                     <h5 class="card-title"><span><i class="fa-solid fa-bars"></i></span> Front Menus</h5>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                           <!-- <h3 class="card-title mb-0">Add Menu</h3> -->
                           <div class="ml-auto">
                              <a href="<?php echo e(route('frontmenu.create')); ?>" class="btn btn-success btn-sm">
                                 <i class="fa fa-plus"></i> Add Front Menu
                              </a>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                              <table id="example" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>Serial#</th>
                                       <th>Main Menus</th>
                                       <th>Main Menu (ID)</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <!-- Input Csrf Token -->
                                 <input type="hidden" class="csrf_token" value="<?php echo e(csrf_token()); ?>">
                                 <!-- End Of Csrf Token -->
                                 <tbody id="sortfrontMenu" class="move">
                                    <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                       <td>
                                         <?php echo e($key+1); ?>

                                         <input type="hidden" class="order-id" value="<?php echo e($menu->id); ?>">
                                      </td>
                                      <td><?php echo e($menu->menu); ?></td>
                                      <td><?php echo e($menu->menu_id); ?></td>
                                      <td>
                                       <a href="<?php echo e(route("front.edit"  , $menu->id)); ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                       <button class="btn btn-danger btn-sm btnDeleteMenu" data-id="<?php echo e($menu->id); ?>">
                                          <i class="fa fa-trash"></i> </button>
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
         </div>
      </div>
   </section>
</div>
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
      $("#sortable").sortable();
      $("#sortable").disableSelection();
   });
</script>
<script type="text/javascript">
   $(document).on('click', '.btnDeleteMenu', function() {
      var frontmenu = $(this).data("id");
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
               url: '/admin/frontmenu/' + frontmenu,
               method: 'DELETE',
               dataType: 'json',
               data: {
                  "frontmenu": frontmenu,
                  "_token": token,
               },
               success: function(res) {
                  if(res.unauthorized == true){
                     swal('Error!', 'No rights To Delete Front Menu', 'error');
                  }
                  if (res.status) {
                     $(row).parents('tr').remove();
                     swal('Updated!', 'Front Menu deleted', 'success');
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
   // Sorting Data
   let sortTable = $("#sortfrontMenu");
   let sortingFrontUrl = "<?php echo e(route('sort.front.menu')); ?>";
   let csrfToken = $(".csrf_token");
   var editUrlFront = "<?php echo e(route('front.edit')); ?>";
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
                  <td >${value.menu}</td>
                  <td>${value.menu_id}</td>
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/frontmenu/index.blade.php ENDPATH**/ ?>