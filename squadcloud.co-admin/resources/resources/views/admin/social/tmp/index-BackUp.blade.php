@extends('admin.layouts.app')
@push('style')
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
                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0"><span><i class="fa-brands fa-twitter"></i></span> Social Links</h3>
                            <div class="ml-auto">
                                <a href="{{ route('social.create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i> Add Social Media
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="table-responsive ">
                                <table class="table table-bordered table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th>Serial#</th>
                                            <th>Social Media Icons</th>
                                            <th>Social Media Links</th>
                                            <th>Icon Colors</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['social'] as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><i class="{{$item->icon}}"></i></td>
                                            <td>{{$item->url}}</td>
                                            <td><center><button class="rounded" disabled style="width: 50px; height:20px; background-color:{{$item->color}};box-shadow:0 0 10px grey ; border:none"></button></center></td>
                                            <td>{{$item->status == 1 ? 'active':'deactive'}}</td>
                                            <td>
                                                <a href="{{route('social.edit',$item->id )}}" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i></a>
                                                <a class="btn btn-danger btn-sm btnDeleteMenu text-white" data-value="{{$item->id}}"><i class="fa fa-trash"></i></a>
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
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        // Delete Script
        let deleteUrl = "{{route('social.destroy')}}";
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
</script>
@endpush