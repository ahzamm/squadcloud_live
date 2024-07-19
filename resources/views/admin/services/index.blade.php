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
                <h3 class="card-title"><span><i class="fa fa-gears"></i></span> Service</h3>
                <a class="btn btn-success btn-sm float-right" href="{{ route('services.create') }}"><i class="fa fa-plus"></i> Add Service</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="example">
                    <thead>
                      <tr>
                        <th>Serial#</th>
                        <th>Service Name</th>
                        <th>Logo</th>
                        <th>TagLine</th>
                        <th>Slug</th>
                        <th>Background Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <input type="hidden" class="csrf_token" value="{{ csrf_token() }}">
                    <tbody id="sortfrontMenu" class="move">
                      @foreach ($services as $key => $item)
                        <tr class="table-row">
                          <td>{{ $key + 1 }}</i><input type="hidden" class="order-id"value="{{ $item->id }}"></td>
                          <td>{{ $item->service }}</td>
                          <td><img width="40px" height="40px" src="{{ asset('frontend_assets/images/services/' . $item->logo) }}" alt="internet service provider in karachi/Clifton/pakistan" /> </td>
                          <td>{{ $item->tagline }}</td>
                          <td>{{ $item->slug }}</td>
                          <td>
                            <img width="40px" height="40px" src="{{ asset('frontend_assets/images/services/' . $item->background_image) }}"
                              alt="internet service provider in karachi/Clifton/pakistan" />
                          </td>
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_check" @if ($item->is_active == 1) checked @endif data-user-id="{{ $item->id }}">
                              <span class="slider round"></span>
                            </label>
                          </td>
                          <td class="d-flex justify-content-center" style="gap: 5px;">
                            <a class="btn btn-primary btn-sm" href="{{ route('services.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
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
    $(function() {
      $("#sortable").sortable();
      $("#sortable").disableSelection();
    });

    function initializeStatusSwitch() {
      $(".status_check").off('change').on('change', function(e) {
        let currentStatus = $(this).prop('checked') ? 1 : 0;
        var status = $(this);
        e.preventDefault();
        $.ajax({
          url: "{{ route('service.status') }}",
          type: "POST",
          data: {
            id: $(this).attr("data-user-id"),
            status: currentStatus
          },
          success: function(response) {
            if (response == "unauthorized") {
              swal("Error!", "Status Not Changed , Because You have No Rights To change status", "error");
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

    function reloadTableData(data) {
      let table = "";
      $(data).each(function(index, value) {
        table += `<tr>
          <td>${index + 1}
          <input type="hidden" class="order-id" value="${value.id}">
          </td>
          <td>${value.service}</td>
          <td><img width="40px" height="40px" src="{{ asset('frontend_assets/images/services/') }}/${value.logo}" alt="service logo" /></td>
          <td>${value.tagline}</td>
          <td>${value.slug}</td>
          <td><img width="40px" height="40px" src="{{ asset('frontend_assets/images/services/') }}/${value.background_image}" alt="service logo" /></td>
          <td>
            <label class="switch">
              <input type="checkbox" class="status_check" ${value.is_active == 1 ? 'checked' : ''} data-user-id="${value.id}">
              <span class="slider round"></span>
            </label>
          </td>
          <td>
            <a href="{{ route('service.edit', '') }}/${value.id}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
            <button class="btn btn-danger btn-sm deleteRecord" data-id="${value.id}">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>`;
      });
      $("#sortfrontMenu").html(table);
      initializeStatusSwitch();
    }

    $(document).ready(function() {
      initializeStatusSwitch();

      let sortTable = $("#sortfrontMenu");
      let sortingFrontUrl = "{{ route('sort.service') }}";
      let csrfToken = $(".csrf_token");

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
              reloadTableData(response);
            }
          });
        }
      });
    });
  </script>
@endpush
