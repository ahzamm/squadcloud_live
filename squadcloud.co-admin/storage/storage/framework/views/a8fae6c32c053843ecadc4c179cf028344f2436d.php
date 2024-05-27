
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
            <div class="card-header d-flex align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-signs-post"></i></span> Coverage Request</h3>
              <div class="card-tools ml-auto">
                <ul class="nav nav-pills">
                  
                  <li class="nav-item">
                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Member Requests</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Consumer Requests</a>
                  </li>
                  <li class="nav-item mt-1">
                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#emailModal">Add Email</a>
                  </li>
                </ul>
              </div>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped exampleTable1">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>City</th>
                          <th>Core Area</th>
                          <!-- <th>Request Type</th> -->
                          <th>Zone Area</th>
                          <th>Request Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $coverageMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($key+1); ?></td>
                          <td><?php echo e($item->name); ?></td>
                          <td><?php echo e($item->email); ?></td>
                          <td><?php echo e($item->mobile_no); ?></td>
                          <td><?php echo e($item->address); ?></td>
                          <td><?php if($item->city != null): ?>
                            <?php echo e($item->city->name); ?>

                          <?php endif; ?></td>
                          <td><?php if($item->coreArea != null): ?>
                            <?php echo e($item->coreArea->name); ?>

                            <?php endif; ?></td>
                          <!-- <td><?php echo e($item->request_type); ?></td> -->
                          <td><?php if($item->zoneArea != null): ?>
                            <?php echo e($item->zoneArea->name); ?>

                          <?php endif; ?></td>
                          <td><?php echo e($item->created_at); ?></td>
                          <td>
                          <button class="btn btn-success btn-sm viewUser" data-toggle="modal" data-target="#infoModal" data-route="<?php echo e(route('coveragerequest.show', ['id' => $item->id])); ?>"><i class="fa fa-eye"></i></button>

                            <a href="#" class="btn btn-danger btn-sm deleteRecord" data-value="<?php echo e($item->id); ?>"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative;">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped exampleTable2">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>City</th>
                          <th>Core Area</th>
                          <th>Zone Area</th>
                          <th>Request Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__currentLoopData = $coverageUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($key+1); ?></td>
                          <td><?php echo e($item->name); ?></td>
                          <td><?php echo e($item->email); ?></td>
                          <td><?php echo e($item->mobile_no); ?></td>
                          <td><?php echo e($item->address); ?></td>
                          <td><?php if($item->city != null): ?>
                            <?php echo e($item->city->name); ?>

                          <?php endif; ?></td>
                          <td><?php if($item->coreArea != null): ?>
                            <?php echo e($item->coreArea->name); ?>

                          <?php endif; ?></td>
                          <td><?php if($item->zoneArea != null): ?>
                            <?php echo e($item->zoneArea->name); ?>

                          <?php endif; ?></td>
                          <td><?php echo e($item->created_at); ?></td>
                          <td style="white-space:nowrap">
                            <button class="btn btn-success btn-sm viewUser" data-toggle="modal" data-target="#infoModal" data-route="<?php echo e(route('coveragerequest.show', ['id' => $item->id])); ?>"><i class="fa fa-eye"></i></button>
                            <button class="btn btn-danger btn-sm deleteRecord" data-value="<?php echo e($item->id); ?>"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


 <!-- Add Email Modal -->
 <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4>Add Email</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
   
          <!-- Modal Body -->
          <form action="<?php echo e(route('emailcoverage.store')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="modal-body" id="emailContainer">

            <?php $__currentLoopData = $data['email_coverages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $coverage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="d-flex gap-5 mb-2" id="row_1">
                <input type="text" class="form-control" name="adminemail[]" value="<?php echo e($coverage->adminemail); ?>" placeholder="Enter Email">
                <button class="btn btn-danger btn-sm deleteRow" onclick="removeRow()"><i class="fa fa-minus"></i></button>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="d-flex gap-5 mb-2" id="row_1">
              <input type="text" class="form-control" name="adminemail[]" placeholder="Enter Email">
              <button type="button" class="btn btn-success" onclick="addRow()"><i class="fa fa-plus"></i></button>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Save</button>
          </div>

          </form>
        </div>
      </div>
    </div>
</div>
<!-- End -->


<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h3>Contact Detail</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="insertProfile" action="<?php echo e(route('user.update' , Auth::user()->id )); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>Core Area</th>
                  <th>Zone Area</th>
                  <th>Request Date</th>
                  </tr>
                  <tbody id="userInfo">
                    
                  </tbody>
                </thead>
              </table>
            </div>
            </div>
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
  function addRow() {
    let htmlRow = '<div class="d-flex gap-5 mb-2"><input type="text" class="form-control" name="adminemail[]" placeholder="Enter Email"><button class="btn btn-danger btn-sm deleteRow" onclick="removeRow()"><i class="fa fa-minus"></i></button></div>';
    $('#emailContainer').append(htmlRow);
  }
  $(document).on('click','.deleteRow',function(){
                $(this).parent().closest('div').remove();
        });
        
  $(function() {
    $(".exampleTable1, .exampleTable2").DataTable({
      "responsive": true,
      "autoWidth": false,
      
    });
  });
  let deleteUrl = "<?php echo e(route('coveragerequest.destroy')); ?>";
  $(document).on('click', '.deleteRecord', function() {
    var logo = $(this).data("value");
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
          url: deleteUrl + '/' + logo,
          method: 'get',
          dataType: 'json',
          success: function(res) {
            if (res.unauthorized == true) {
              swal('Error!', 'No Rights To delete Coverage Requests', 'error');
            } 
            if (res.status) {
              $(row).parents('tr').remove();
              swal('Updated!', 'Coverage Request deleted', 'success');
              location.reload();
              // console.log("delete record");
            } else {
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

<script>
 $(document).ready(function(){
    $(document).on('click', '.viewUser', function(){
        var userId = $(this).data('value');
        var route = $(this).data('route'); // Get the route from data attribute

        $('#userInfo').html('<tr><td class="text-center" colspan="9"><strong>Data Loading...</strong></td></tr>');

        $.ajax({
            url: route,
            method: 'GET',
            data: { id: userId, nocache: new Date().getTime() }, // Pass the user ID as data
            success: function(response){
                // Check if response contains necessary data
                if (response) {
                    var cityName = response.city ? response.city.name : 'N/A';
                    var coreAreaName = response.core_area ? response.core_area.name : 'N/A';
                    var zoneAreaName = response.zone_area ? response.zone_area.name : 'N/A';

                    // Update modal body with user details
                    $('#userInfo').html('<tr><td>' + response.id + '</td><td>' + response.name + '</td><td>' + response.email + '</td><td>' + response.mobile_no + 
                    '</td><td>' + (response.address ? response.address : "") + '</td><td>' + cityName + '</td><td>' + coreAreaName + 
                    '</td><td>' + zoneAreaName + '</td><td>' + response.created_at + '</td></tr>');

                    console.log(response);
                } else {
                    console.log('No data found for the user.');
                }
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    });
});
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/coveragerequest/index.blade.php ENDPATH**/ ?>