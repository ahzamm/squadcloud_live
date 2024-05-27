<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">    
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
              <h3 class="card-title"><span><i class="fa-solid fa-network-wired"></i></span> Allowed IP Addresses</h3>
              <button class="btn btn-success btn-sm float-right" id="addIp"><i class="fa fa-plus"></i> Add IP Address</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped" id="example1">
                <thead>
                  <tr>
                    <th>Serial#</th>
                    <th>Full Name</th>
                    <th>IP Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e(++$key); ?></td>
                    <td><?php echo e($item->person_name); ?></td>
                    <td><?php echo e($item->ip_address); ?></td>
                    <td>
                      <button class="btn btn-primary btn-sm btnEditIP" data-value="<?php echo e($item->id); ?>"><i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger btn-sm btnDeleteIP" data-value="<?php echo e($item->id); ?>"><i class="fa fa-trash"></i></button>
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
  </section>
</div>
<?php echo $__env->make('admin.allowedip._modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true
    //   "autoWidth": false,
  });
  });
  $(document).on('click','#addIp',function(){
    $('#AllowedIpModel').modal('show').find('.modal-content').html(`<div class="modal-body">
      <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
      </div>`);
    id = $(this).attr('data-value');
    $.ajax({
      method:'get',
      url:'/admin/allowedip/create',
      dataType: 'html',
      success:function(res){
        $('#AllowedIpModel').find('.modal-content').html(res);
      }
    })
  })
  $(document).on('submit','#ipAddForm',function(e){
    e.preventDefault();
    $.ajax({
      url: "<?php echo e(route('allowedip.store')); ?>",
      type: "POST",
      data:  new FormData(document.forms.namedItem("ipAddForm")),
      contentType: false,
      cache: false,
      processData:false,
      dataType:'JSON',
      beforeSend:function(){
        $('#loader-img').css('display','block');
      },
      success:function(res){
       if($.isEmptyObject(res.error)){
        if(res.status)
        {
         window.location.reload();
       }
     }
     else
     {
      printErrorMsg(res.error,'#AllowedIpError');
    }
  },
  error:function(jhxr,status,err)
  {
   console.log(jhxr);
 },
 complete:function()
 {
   $('#loader-img').css('display','none');
 }
});
  })
  $(document).on('click','.btnDeleteIP',function(){
    if(!confirm("Are you sure you want to delete this record"))
    {
      return;
    }
    id = $(this).attr('data-value');
    $.ajax({
      method:'delete',
      url:'/admin/allowedip/'+id,
      dataType: 'json',
      success:function(res){
        if(res.status)
        {
          window.location.reload();
        }
      }
    })
  })
  $(document).on('click','.btnEditIP',function(){
    $('#AllowedIpModel').modal('show').find('.modal-content').html(`<div class="modal-body">
      <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
      </div>`);
    id = $(this).attr('data-value');
    $.ajax({
      method:'get',
      url:'/admin/allowedip/'+id+'/edit',
      dataType: 'html',
      success:function(res){
        $('#AllowedIpModel').find('.modal-content').html(res);
      }
    })
  })
  $(document).on('submit','#ipEditForm',function(e){
    e.preventDefault();
    $.ajax({
      url: "<?php echo e(route('allowedip.update',1)); ?>",
      type: "PUT",
      data:  $('#ipEditForm').serialize(),
      dataType:'JSON',
      beforeSend:function(){
        $('#loader-img').css('display','block');
      },
      success:function(res){
       if($.isEmptyObject(res.error)){
        if(res.status)
        {
         window.location.reload();
       }
     }
     else
     {
      printErrorMsg(res.error,'#EditAllowedIpError');
    }
  },
  error:function(jhxr,status,err)
  {
   console.log(jhxr);
 },
 complete:function()
 {
   $('#loader-img').css('display','none');
 }
});
  })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/allowedip/index.blade.php ENDPATH**/ ?>