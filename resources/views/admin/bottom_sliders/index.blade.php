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

    .ui-sortable-helper {
      display: table;
      width: 100%;
      background: #fff;
      border: 1px solid #ddd;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .ui-sortable-placeholder {
      display: table;
      width: 100%;
      visibility: visible !important;
      background: #f0f0f0;
      border: 1px dashed #ddd;
      height: 40px;
    }
  </style>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card mt-3 card-outline card-info">
              <div class="card-header">
                <h3 class="card-title"><span><i class="fa fa-photo-film"></i></span> Bottom Sliders</h3>
                <a class="btn btn-success btn-sm float-right" href="{{ route('bottom_sliders.create') }}"><i class="fa fa-plus"></i> Add Bottom Sliders</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="example1">
                    <thead>
                      <tr>
                        <th>Serial#</th>
                        <th>Slider Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="sortfrontMenu" class="move">
                      @foreach ($bottom_sliders as $key => $item)
                        <tr class="table-row">
                          <!-- <td><i class="fas fa-sort" id="sort-serial"></i></td> -->
                          <td class="serial-number">{{ $key + 1 }}<input type="hidden" class="order-id" value="{{ $item->id }}"></td>
                          <td>
                            <img width="100px" height="40px" src="{{ asset('frontend_assets/images/bottom_sliders/' . $item->image) }}" alt="internet product provider in karachi/Clifton/pakistan" />
                          </td>
                          <td>{{ $item->title }}</td>
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_check" @if ($item->is_active == 1) checked @endif data-user-id="{{ $item->id }}">
                              <span class="slider round"></span>
                            </label>
                          </td>
                          <td class="d-flex justify-content-center" style="gap: 5px;">
                            <a class="btn btn-primary btn-sm" href="{{ route('bottom_sliders.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                          </td>
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
    $(function() {
      $("#sortfrontMenu").sortable({
        helper: function(e, ui) {
          ui.children().each(function() {
            $(this).width($(this).width());
          });
          return ui;
        },
        placeholder: "ui-sortable-placeholder"
      });
      $("#sortable").disableSelection();
    });

    $(document).ready(function() {
      $("#example1").DataTable({
        "responsive": true
      });

      // Changing Status with event delegation
      let changeStatusUrl = "{{ route('bottom_slider.status') }}";
      $(document).on('change', '.status_check', function(e) {
        let currentStatus = $(this).prop('checked') ? 1 : 0;
        var status = $(this);
        e.preventDefault();
        $.ajax({
          url: changeStatusUrl,
          type: "POST",
          data: {
            id: $(this).attr("data-user-id"),
            status: currentStatus
          },
          success: function(response) {
            if (response == "unauthorized") {
              swal("Error!", "Status Not Changed, Because You have No Rights To change status", "error");
              status.prop('checked', false);
            } else if (response == "success") {
              swal({
                title: 'Status Changed!',
                text: "User Status Has been Changed!",
                animation: false,
                customClass: 'animated pulse',
                type: 'success',
              });
            }
          }
        });
      });

      // Delete BottomSlider with event delegation
      let deleteUrl = "{{ route('bottom_slider.destroy', ':id') }}";

     // Function to update serial numbers
     function updateSerialNumbers() {
      $('#example1 tbody tr').each(function(index) {
        $(this).find('td').first().text(index + 1); // Assuming the serial number is in the first column
      });
    }

      $(document).on('click', '.btnDeleteMenu', function() {
        let sliderId = $(this).attr('data-value');
      var row = $(this).closest('tr');
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
              url: deleteUrl.replace(':id', sliderId),
              method: 'get',
              data: {
                "_token": "{{ csrf_token() }}",
              },
              success: function(res) {
                if (res.status == true) {
                row.remove();
                updateSerialNumbers();
                  swal('Updated!', 'Bottom Slider Has been deleted', 'success');
                } else if (res.status == "no Access") {
                  swal('Error!', 'You have no access to delete bottom sliders', 'error');
                }
              },
              error: function(jhxr, status, err) {
                console.log(jhxr);
              }
            })
          }
        });
      });

      // Sorting Data
      let sortTable = $("#sortfrontMenu");
      let sortingFrontUrl = "{{ route('sort.bottom_slider') }}";
      let csrfToken = $(".csrf_token");
      var editUrlFront = "{{ route('bottom_slider.edit', ':id') }}";

      $(sortTable).sortable({
        update: function(event, ui) {
          var SortIds = $(this).find('.order-id').map(function() {
            return $(this).val().trim();
          }).get();

          $.ajax({
            url: sortingFrontUrl,
            type: "POST",
            data: {
              sort_Ids: SortIds
            },
            headers: {
              "X-CSRF-TOKEN": csrfToken.val()
            },
            success: function(response) {
              let table = "";
              $(response).each(function(index, value) {
                table += `<tr>
                  <td>${index + 1}<input type="hidden" class="order-id" value="${value.id}"></td>
                  <td><img width="100px" height="40px" src="{{ asset('frontend_assets/images/bottom_sliders/') }}/${value.image}" alt="slider image"></td>
                  <td>${value.title}</td>
                  <td>
                    <label class="switch">
                      <input type="checkbox" class="status_check" ${value.is_active == 1 ? 'checked' : ''} data-user-id="${value.id}">
                      <span class="slider round"></span>
                    </label>
                  </td>
                  <td class="d-flex justify-content-center" style="gap: 5px;">
                                <a class="btn btn-primary btn-sm" href="${editUrlFront.replace(':id', value.id)}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="${value.id}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>`;
              });
              $(sortTable).html(table);

              // Re-initialize status check event delegation after sorting
              $(document).on('change', '.status_check', function(e) {
                let currentStatus = $(this).prop('checked') ? 1 : 0;
                var status = $(this);
                e.preventDefault();
                $.ajax({
                  url: changeStatusUrl,
                  type: "POST",
                  data: {
                    id: $(this).attr("data-user-id"),
                    status: currentStatus
                  },
                  success: function(response) {
                    if (response == "unauthorized") {
                      swal("Error!", "Status Not Changed, Because You have No Rights To change status", "error");
                      status.prop('checked', false);
                    } else if (response == "success") {
                      swal({
                        title: 'Status Changed!',
                        text: "User Status Has been Changed!",
                        animation: false,
                        customClass: 'animated pulse',
                        type: 'success',
                      });
                    }
                  }
                });
              });
            }
          });
        },
        helper: function(e, ui) {
          ui.children().each(function() {
            $(this).width($(this).width());
          });
          return ui;
        },
        placeholder: "ui-sortable-placeholder"
      });
    });
  </script>
@endpush
