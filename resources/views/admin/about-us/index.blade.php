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
                            <h3 class="card-title"><span><i class="fa-solid fa-pencil"></i></span> About Us</h3>
                            <a class="btn btn-success btn-sm float-right" href="{{ route('aboutus.create') }}"><i class="fa fa-plus"></i>
                                Add About Us
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <span class="success-delete"></span>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Serial#</th>
                                            <th>About Us Description</th>
                                            <th>Images</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($about_us as $key => $item)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{!! $item->description!!}</td>
                                            @php
                                            $images = explode('","' , $item->images);
                                            $image= str_ireplace( array( '\'', '"',',' , ';', '<', '>' ,'[',']',' ', ),' ', $images);
                                            @endphp
                                            <td>
                                                <img width="40px" height="40px" src="{{asset('about-us/'.trim($image[0]))}}" alt="internet service provider in karachi/Clifton/pakistan" />
                                            </td>
                                            <td class="d-flex">
                                                {{-- <button class="btn btn-success btn-sm viewFrontPages"
                                                data-value="{{ $item->id }}"><i class="fa fa-eye"></i></button> --}}
                                                <a class="btn btn-primary btn-sm mx-2"
                                                href="{{ route('aboutus.edit', $item->id) }}"><i
                                                class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm deleteRecord " data-id="{{ $item->id }}"><i
                                                    class="fa fa-trash"></i> </button>
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
    @include(' admin.front-faq._modal') @endsection @push('scripts') <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
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
            id = $(this).attr('data-value');
            $.ajax({
                method: 'get',
                url: '/admin/aboutus/' + id,
                dataType: 'html',
                success: function(res) {
                    $('#frontPagesModal').find('.modal-content').html(res);
                }
            })
        })
    </script>
    <script type="text/javascript">
                                                    // //   delete button
                                                    $(document).on('click', '.deleteRecord', function() {
                                                        var aboutus = $(this).data("id");
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
                                                                    url: '/admin/aboutus/' + aboutus,
                                                                    method: 'DELETE',
                                                                    dataType: 'json',
                                                                    data: {
                                                                        "aboutus": aboutus,
                                                                        "_token": token,
                                                                    },
                                                                    success: function(res) {
                                                                        if (res.status == true) {
                                                                            $(row).closest('tr').remove();
                                                                            swal('Updated!', 'About us Data  deleted', 'success');
                                                                            // console.log("delete record");
                                                                        } if(res.unauthorized==true) {
                                                                            swal('Error!', 'No Rights To delete About Us Information', 'error');
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
                                                    //  end of delete button
                                                </script>
                                                @endpush