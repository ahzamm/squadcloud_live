@extends('admin.layouts.app')
@push('style')
  <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('site/sweet-alert/sweetalert2.css') }}">
@endpush
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card mt-3 card-outline card-info">
              <div class="card-header">
                <h3 class="card-title"><span><i class="fa-solid fa-box-open"></i></span> Job Applications</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="example1">
                    <thead>
                      <tr>
                        <th>Serial#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Cover Letter</th>
                        <th>Submission Date</th>
                        <th>Resume</th>
                        <th>Job Title</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="move">
                      @foreach ($job_applications as $key => $item)
                        <tr class="table-row">
                          <td>{{ $key + 1 }}<input type="hidden" class="order-id" value="{{ $item->id }}"></td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->email }}</td>
                          <td>{{ $item->phone }}</td>
                          <td>{{ $item->cover_letter }}</td>
                          <td>{{ substr($item->created_at, 0, 10) }}</td>
                          <td>
                            <button class="btn btn-primary btn-sm download-resume" data-url="{{ asset('backend/resumes/' . $item->resume) }}">
                              <i class="fa fa-download"></i> Download
                            </button>
                          </td>
                          <td>{{ $item->job->job_title }}</td>
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
  <script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
  <script>
    let packageDeleteUrl = "{{ route('job_application.destroy') }}";

    $(document).on('click', '.btnDeleteMenu', function() {
      id = $(this).attr('data-value');
      var row = $(this);
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
                swal('Error!', 'No Rights To delete Job Application', "error");
              }
              if (res.status) {
                $(row).parents('tr').remove();
                swal('Updated!', 'Job Application deleted', 'success');
              }
            },
            error: function(jhxr, status, err) {
              console.log(jhxr);
            }
          })
        }
      })
    });


    $(document).on('click', '.download-resume', function() {
      var url = $(this).data('url');
      var extension = url.split('.').pop();
      var a = document.createElement('a');
      a.href = url;
      a.download = 'Resume.' + extension;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    });
  </script>
@endpush
