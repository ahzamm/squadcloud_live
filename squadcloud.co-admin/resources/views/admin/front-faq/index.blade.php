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
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0"><span><i class="fa-solid fa-circle-question"></i></span> Frequently Asked Questions (FAQ)</h3>
                            <div class="d-flex align-items-center ml-auto">
                                <a class="btn btn-success btn-sm mr-2" href="{{ route('front-faqs.create') }}">
                                    <i class="fa fa-plus"></i> Add Frequently Asked Questions (FAQ)
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Serial#</th>
                                            <th>Questions</th>
                                            <th>Answers</th>
                                            <th>Status</th>
                                            <th>In Order</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($frontfaq as $key=> $item)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{!!$item->question!!}</td>
                                            <td>{!!$item->answer!!}</td>
                                            <td>{{$item->active == 1?'active':'deactive'}}</td>
                                            <td>{{$item->faq_order}}</td>
                                            <td class="d-flex g-2">
                                                <a class="btn btn-primary btn-sm mx-2" href="{{route('front-faqs.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
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
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true
        });
    });
    $(document).on('click', '#sortMenu', function() {
        $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
            </div>`);
        $.ajax({
            method: 'get',
            url: '{{route("faqs.sort")}}',
            dataType: 'html',
            success: function(res) {
                console.log(res);
                $('#frontPagesModal').find('.modal-content').html(res);
                $('.todo-list').disableSelection();
                $('.todo-list').sortable({
                    placeholder: 'sort-highlight',
                    handle: '.handle',
                    forcePlaceholderSize: true,
                    zIndex: 999999,
                    update: function(event, ui) {
                        // console.log(ui.item);
                        $.ajax({
                            url: "/admin/front-faqs/sort",
                            type: "POST",
                            data: new FormData(document.forms.namedItem("faqSortForm")),
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: 'JSON',
                            success: function(res) {},
                            error: function(jhxr, status, err) {
                                console.log(jhxr);
                            },
                            complete: function() {
                            }
                        });
                    }
                });
            }
        })
    });
    //   delete 
    let deleteUrl = "{{ route('faq.destroy')}}";
    $(document).on('click', '.deleteRecord', function() {
        var id = $(this).data("id");
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
                    url: deleteUrl + '/' + id,
                    method: 'post',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            swal('Updated!', 'Front Faq deleted', 'success');
                            location.reload();
                        } 
                        if (res.unauthorized == true) {
                            swal('Error!', 'No rights To delete FAQ', 'error');
                        }   else {
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