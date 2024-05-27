@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
                            <h3 class="card-title">Message Web-Page</h3>
                            <a class="btn btn-success btn-sm float-right" href="{{ route('message.create') }}"><i
                                class="fa fa-plus"></i></a>
                            </div>
                            <!-- /.card-header -->
                            <span class="success-delete"></span>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Message</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($message as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->message}}</td>
                                            <td><img src="{{ asset('message/'.$item->image) }}" height="60" width="120" alt="" srcset="" ></td>
                                            <td>{{$item->active == 1?'active':'deactive'}}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm viewFrontPages" data-value="{{ $item->id }}"><i class="fa fa-eye"></i></button>
                                                <a class="btn btn-primary btn-sm" href="{{ route('message.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
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
        </section>
    </div>
    @include('admin.front-faq._modal')
    @endsection
    @push('scripts')
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
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
                url: '/admin/message/' + id,
                dataType: 'html',
                success: function(res) {
                    $('#frontPagesModal').find('.modal-content').html(res);
                }
            })
        })
    </script>
    <script type="text/javascript">
        $(".deleteRecord").click(function(){
            var message = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax(
            {
                url: '/admin/message/' + message,
                type: 'DELETE',
                data: {
                    "message": message,
                    "_token": token,
                },
                success: function (res){
                    $('#frontPagesModal').find('.modal-content').html(res);
    //  alert(data)
    location.reload(true);
}
});
        });
    </script>
    @endpush