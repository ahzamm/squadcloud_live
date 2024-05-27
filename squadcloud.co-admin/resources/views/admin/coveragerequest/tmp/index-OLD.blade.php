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
                </ul>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative;">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
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
                        @foreach ($coverageMembers as $key => $item)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$item->name}}</td>
                          <td>{{$item->email}}</td>
                          <td>{{$item->mobile_no}}</td>
                          <td>{{$item->address}}</td>
                          <td>@if($item->city != null)
                            {{$item->city->name}}
                          @endif</td>
                          <td>@if($item->coreAream != null)
                            {{$item->coreArea->name}}
                            @endif
                          </td>
                          <td>@if($item->zoneArea != null)
                            {{$item->zoneArea->name}}
                          @endif</td>
                          <td>{{$item->created_at}}</td>
                          <td>
                          <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#infoModal" data-value="{{$item->id}}"><i class="fa fa-eye"></i></button>

                            <a href="#" class="btn btn-danger btn-sm deleteRecord" data-value="{{$item->id}}"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative;">
                  <div class="table-responsive">
                    <table class="table exampleTable2">
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
                        @foreach ($coverageUsers as $key => $item)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$item->name}}</td>
                          <td>{{$item->email}}</td>
                          <td>{{$item->mobile_no}}</td>
                          <td>{{$item->address}}</td>
                          <td>@if($item->city != null)
                            {{$item->city->name}}
                          @endif</td>
                          <td>@if($item->coreArea != null)
                            {{$item->coreArea->name}}
                          @endif</td>
                          <td>@if($item->zoneArea != null)
                            {{$item->zoneArea->name}}
                          @endif</td>
                          <td>{{$item->created_at}}</td>
                          <td style="white-space:nowrap">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#infoModal" data-value="{{$item->id}}"><i class="fa fa-eye"></i></button>
                            <button class="btn btn-danger btn-sm deleteRecord" data-value="{{$item->id}}"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>
                        @endforeach
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
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h3>Contact Detail</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="insertProfile" action="{{route('user.update' , Auth::user()->id )}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Modal Body -->
            <div class="modal-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>col 1</th>
                    <th>col 2</th>
                  </tr>
                  <tbody>
                    <tr>
                      <td>row1</td>
                      <td>row 1</td>
                    </tr>
                  </tbody>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('scripts')
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
<script>
  $(function() {
    $(".exampleTable1, .exampleTable2").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
  let deleteUrl = "{{route('coveragerequest.destroy')}}";
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
@endpush