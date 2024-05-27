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
 @extends('admin.layouts.app')
 @push('style')
 <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
 <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
 <link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
 @endpush
 @section('content')
 <div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0"><span><i class="fa-solid fa-venus"></i></span> Why ChooseUs</h3>
                            <a href="{{ route('whychoose.create') }}" class="btn btn-success btn-sm ml-auto">
                                <i class="fa fa-plus"></i> Add Why ChooseUs
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table class="table table-bordered table-striped" id="example1" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Serial#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($whyChooseUs as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{!!$item->description!!}</td>
                                            <td><img src="{{ asset('whychoose-us/'.$item->image) }}" height="60" width="60" alt="" srcset=""></td>
                                            <td>{{ $item->active == 1 ? 'Active' : 'In-active' }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm viewFrontPages" data-value="{{ $item->id }}"><i class="fa fa-eye"></i>
                                                </button>
                                                <a class="btn btn-primary btn-sm" href="{{ route('whychoose.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm deleteRecord" data-id="{{ $item->id }}"><i class="fa fa-trash"></i>
                                                </button>
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
    $(document).ready(function() {
        $("#example1").DataTable({
            "responsive": true
        });
    });
    $(document).on('click', '.viewFrontPages', function() {
        $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
            </div>`);
        id = $(this).attr('data-value');
        $.ajax({
            method: 'get',
            url: '/admin/whychoose/' + id,
            dataType: 'html',
            success: function(res) {
                $('#frontPagesModal').find('.modal-content').html(res);
            }
        })
    })
</script>
<script type="text/javascript">
    $(document).on('click', '.deleteRecord', function() {
        var whychoose = $(this).data("id");
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
                    url: '/admin/whychoose/' + whychoose,
                    method: 'DELETE',
                    dataType: 'json',
                    data: {
                        "whychoose": whychoose,
                        "_token": token,
                    },
                    success: function(res) {
                        if(res.unauthorized){
                            swal("Error!" , "No Rights To Delete Why choose Us Informations" , "error");
                        }
                        if (res.status) {
                            $(row).parents('tr').remove();
                            swal('Updated!', 'Why Choose Us deleted', 'success');
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
</script>
@endpush
<!-- Code Finalize -->