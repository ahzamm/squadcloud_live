@extends('admin.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/sweet-alert/sweetalert2.css') }}">
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
                                <h3 class="card-title"><span><i class="fa-solid fa-box-open"></i></span> Contacts</h3>
                                <div class="float-right">
                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#emailModal">Add Recipient</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="example1">
                                        <thead>
                                            <tr>
                                                <th>Serial#</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Service Required</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contacts as $key => $item)
                                                <tr class="table-row">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->full_name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>{{ $item->service_required }}</td>
                                                    <td>{{ $item->message }}</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm btnDeleteMenu"
                                                            data-value="{{ $item->id }}"><i
                                                                class="fa fa-trash"></i></button>
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
                <form action="{{route('emailcontact.store')}}" method="POST" id="emailForm">
                    @csrf
                    <div class="modal-body" id="emailContainer">
                        @foreach ($data['email_contacts'] as $key => $contact)
                            <div class="d-flex gap-5 mb-2 email-row" id="row_{{ $key }}">
                                <input type="text" class="form-control" name="adminemail[]" value="{{$contact->adminemail}}" placeholder="Enter Email">
                                <button class="btn btn-danger btn-sm deleteRow" type="button" onclick="removeRow(this)"><i class="fa fa-minus"></i></button>
                            </div>
                        @endforeach

                        <!-- Add Email Button Alone -->
                        <div class="d-flex gap-5 mb-2" id="addEmailButton">
                            <button type="button" class="btn btn-success" onclick="addRow()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.front-faq._modal')
@endsection
@push('scripts')
    <script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
    <script>
        let packageDeleteUrl = "{{ route('contact_request.destroy') }}";
        $(document).on('click', '.btnDeleteMenu', function() {
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
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: packageDeleteUrl + '/' + id,
                        method: 'get',
                        dataType: 'json',
                        success: function(res) {
                            if (res.unauthorized) {
                                swal('Error!', 'No Rights To delete Contact', "error");
                            }
                            if (res.status) {
                                swal('Updated!', 'Contact deleted', 'success');
                                location.reload();
                            }
                        },
                        error: function(jhxr, status, err) {
                            console.log(jhxr);
                        }
                    })
                }
            })
        })

        function addRow() {
            let htmlRow = '<div class="d-flex gap-5 mb-2 email-row"><input type="text" class="form-control" name="adminemail[]" placeholder="Enter Email"><button class="btn btn-danger btn-sm deleteRow" type="button" onclick="removeRow(this)"><i class="fa fa-minus"></i></button></div>';
            $('#addEmailButton').before(htmlRow);
        }

        function removeRow(button) {
            $(button).closest('div.email-row').remove();
        }

        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        $('#emailForm').on('submit', function(e) {
            let isValid = true;
            let invalidEmails = false;
            $('input[name="adminemail[]"]').each(function() {
                if ($(this).val().trim() === '') {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else if (!validateEmail($(this).val().trim())) {
                    isValid = false;
                    invalidEmails = true;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                if (invalidEmails) {
                    toastr.error('Please enter valid email addresses.');
                } else {
                    toastr.error('Please fill out all email fields.');
                }
            }
        });

        $(function () {
            $("#example1").DataTable({
                "responsive": true
            });
        });

        $(document).on('click', '#emailEdit', function() {
            $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
                <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
                </div>`);
            id = $(this).attr('data-value');
            $.ajax({
                method: 'get',
                url: '/admin/front-emails/edit',
                dataType: 'html',
                success: function(res) {
                    $('#frontPagesModal').find('.modal-content').html(res);
                },
                error: function(jhxr, err, status) {
                    console.log(jhxr);
                }
            })
        })
    </script>
@endpush
