@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">  
@endpush
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mt-3">
            <div class="card-header">
              <h3 class="card-title"><span><i class="fa-solid fa-copyright"></i></span> Brand (Logo)</h3>
              <a class="btn btn-success btn-sm float-right" href="{{ route('logo.create') }}"><i class="fa fa-plus"></i> Add Brand logo</a>
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
                    @foreach ($logo as $key => $item)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td><img src="{{ asset('front-logo/'.$item->image) }}" height="60" width="120" alt="" srcset=""></td>
                      <td><img src="{{ asset('small-front-logo/'.$item->small_image) }}" height="60" width="120" alt="" srcset=""></td>
                      <td>{{$item->title}}</td>
                      <td>{{$item->footer}}</td>
                      <td>{{ $item->active == 1 ? 'Active' : 'In-active' }}</td>
                      <td>
                        {{-- <button class="btn btn-success btn-sm viewFrontPages"
                        data-value="{{ $item->id }}"><i class="fa fa-eye"></i></button> --}}
                        <a class="btn btn-primary btn-sm" href="{{ route('logo.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm deleteRecord" data-id="{{ $item->id }}"><i class="fa fa-trash"></i> </button>
                      </td>
                    </tr>
                    @endforeach
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
@include('admin.front-faq._modal')
@endsection
@push('scripts')
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
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
@endpush