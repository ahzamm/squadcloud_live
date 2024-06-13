@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
@endpush
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mt-3 card-outline card-info">
            <div class="card-header">
              <h3 class="card-title"><span><i class="fa-solid fa-box-open"></i></span> Newsletter Subscribers</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                      <th>Serial#</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="move">
                    @foreach ($subscribers as $key=> $item)
                    <tr class="table-row">
                      <td>{{ $key + 1 }}<input type="hidden" class="order-id" value="{{ $item->id }}"></td>
                      <td>{{$item->email}}</td>
                      <td class="d-flex justify-content-center" style="gap: 5px;">
                        <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="{{ $item->id }}"><i class="fa fa-trash"></i></button>
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
<script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
<script>
  let packageDeleteUrl  = "{{route('subscriber.destroy')}}";
  $(document).on('click' ,'.btnDeleteMenu' ,function(){
    id = $(this).attr('data-value');
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
          url:packageDeleteUrl+'/'+ id,
          method:'get',
          dataType:'json',
          success:function(res){
            if(res.unauthorized){
              swal('Error!' , 'No Rights To delete Subscriber' , "error");
            }
            if(res.status)
            {
              swal('Updated!', 'Subscriber deleted', 'success');
              location.reload();
            }
            else
            {
              // Handle other errors
            }
          },
          error:function(jhxr,status,err){
            console.log(jhxr);
          }
        })
      } else if (result.dismiss === 'cancel') {
        // Handle cancel action
      }
    })
  })
</script>
@endpush
