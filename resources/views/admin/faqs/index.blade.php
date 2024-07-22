@extends('admin.layouts.app')
@push('style')
  <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('site/sweet-alert/sweetalert2.css') }}">
@endpush
@section('content')
  <style>
    .move {
      cursor: move;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 55px;
      height: 27px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: green;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card mt-3 card-outline card-info">
              <div class="card-header">
                <h3 class="card-title"><span><i class="fa-solid fa-box-open"></i></span> FAQs</h3>
                <a class="btn btn-success btn-sm float-right ml-1" href="{{ route('faq_categories.index') }}">FAQ Categories</a>
                <a class="btn btn-success btn-sm float-right ml-1 btnAddImage"><i class="fa fa-plus"></i> Add Title Image</a>
                <a class="btn btn-success btn-sm float-right ml-1" href="{{ route('faqs.create') }}"><i class="fa fa-plus"></i> Add FAQ</a>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="example1">
                    <thead>
                      <tr>
                        <th>Sort</th>
                        <th>Serial#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="sortfrontMenu" class="move">
                      @foreach ($faqs as $key => $item)
                        <tr class="table-row">
                          <td><i class="fas fa-sort" id="sort-serial"></i></td>
                          <td>{{ $key + 1 }}<input type="hidden" class="order-id"value="{{ $item->id }}"></td>
                          <td>{!! $item->question !!}</td>
                          <td>{!! $item->answer !!}</td>
                          <td>{{ $item->category->category }}</td>
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_check" @if ($item->is_active == 1) checked @endif data-user-id="{{ $item->id }}">
                              <span class="slider round"></span>
                            </label>
                          </td>
                          <td class="d-flex justify-content-center" style="gap: 5px;">
                            <a class="btn btn-primary btn-sm" href="{{ route('faq.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
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

  {{-- Title Image Modal --}}
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="applyModalLabel">Title Image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
          <form id="imageForm" action="{{ route('faq.image.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              @isset($faq_image->title_image)
                <img src="{{ asset('frontend_assets/images/title/' . $faq_image->title_image) }}" height="60" width="120" alt="">
              @endisset
              <br><br>
              <input type="file" name="title_image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
  <script>
    $(function() {
      $("#sortable").sortable();
      $("#sortable").disableSelection();
    });

    // Changing Status with event delegation
    let changeStatusUrl = "{{ route('faq.status') }}";
    $(document).on('change', '.status_check', function(e) {
      let currentStatus = "";
      if ($(this).prop('checked') == true) {
        currentStatus = 1;
        $(this).closest('tr').find('.status').text('active');
      } else {
        currentStatus = 0;
        $(this).closest('tr').find('.status').text('deactive');
      }
      var status = $(this);
      e.preventDefault();
      $.ajax({
        url: changeStatusUrl,
        type: "Post",
        data: {
          id: $(this).attr("data-user-id"),
          status: currentStatus
        },
        success: function(response) {
          if (response == "unauthorized") {
            e.preventDefault();
            swal("Error!", "Status Not Changed , Because You have No Rights To change status", "error");
            status.prop('checked', false);
          }
          if (response == "success") {
            swal({
              title: 'Status Changed!',
              text: "Faq Status Has been Changed!",
              animation: false,
              customClass: 'animated pulse',
              type: 'success',
            });
          }
        }
      })
    });

    // Delete with event delegation
    let packageDeleteUrl = "{{ route('faq.destroy') }}";
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
                swal('Error!', 'No Rights To delete Job', "error");
              }
              if (res.status) {
                swal('Updated!', 'Job deleted', 'success');
                location.reload();
              }
            },
            error: function(jhxr, status, err) {
              console.log(jhxr);
            }
          })
        }
      })
    });

    $(function() {
      $("#example1").DataTable({
        "responsive": true
      });
    });

    let sortTable = $("#sortfrontMenu");
    let sortingFrontUrl = "{{ route('sort.faq') }}";
    let csrfToken = $(".csrf_token");
    var editUrlFront = "{{ route('faq.edit') }}";
    $(sortTable).sortable({
      update: function(event, ui) {
        var SortIds = $(this).find('.order-id').map(function() {
          return $(this).val().trim();
        }).get();
        // Sending Ajax to update the sort ids and change the data sorting
        $.ajax({
          url: sortingFrontUrl,
          type: "post",
          data: {
            sort_Ids: SortIds
          },
          headers: {
            "X-CSRF-TOKEN": csrfToken.val()
          },
          success: function(response) {
            let table = "";
            $(response).each(function(index, value) {
              table += ` <tr>
                        <td><i class="fas fa-sort" id="sort-serial"></i></td>
            <td>${index + 1 }<input type="hidden" class="order-id" value="${value.id}"></td>
             <td>${value.question}</td>
             <td>${value.answer}</td>
             <td>${value.category && value.category.category ? value.category.category : 'N/A'}</td>
             <td>
          <label class="switch">
            <input type="checkbox" class="status_check" ${value.is_active == 1 ? 'checked' : ''} data-user-id="${value.id}">
            <span class="slider round"></span>
          </label>
        </td>
            <td class="d-flex justify-content-center" style="gap: 5px;">
                          <a class="btn btn-primary btn-sm" href="` + editUrlFront + "/" + value.id + `" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="${value.id}">
            <i class="fa fa-trash"></i> </button>
            </td>
            </tr>`;
            });
            $(sortTable).html(table);
          }
        });
      }
    });

    $(document).on('click', '.btnAddImage', function() {
      $('#imageModal').modal('show');
    });
  </script>
@endpush
