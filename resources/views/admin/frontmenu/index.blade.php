@extends('admin.layouts.app')
@push('style')
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('site/sweet-alert/sweetalert2.css') }}">
@endpush
@section('content')
@section('title', 'All Menus')
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
          <div class="card mt-3">
            <div class="card-header">
              <h5 class="card-title"><span><i class="fa-solid fa-bars"></i></span> Site Menus</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div class="ml-auto">
                    <a href="{{ route('frontmenu.create') }}" class="btn btn-success btn-sm">
                      <i class="fa fa-plus"></i> Add Site Menu
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <!-- <th>Sort</th> -->
                          <th>Serial#</th>
                          <th>Main Menus</th>
                          <th>Route</th>
                          <th>Page Title</th>
                          <th>Tagline</th>
                          <th>Title Image</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <input type="hidden" class="csrf_token" value="{{ csrf_token() }}">
                      <tbody id="sortfrontMenu" class="move">
                        @foreach ($collection as $key => $menu)
                          <tr>
                            <!-- <td><i class="fas fa-sort" id="sort-serial"></i></td> -->
                            <td>
                              {{ $key + 1 }}
                              <input type="hidden" class="order-id" value="{{ $menu->id }}">
                            </td>
                            <td>{{ $menu->menu }}</td>
                            <td>{{ $menu->slug }}</td>
                            <td>{{ $menu->page_title }}</td>
                            <td>{{ $menu->tagline }}</td>
                            <td>
                              @if (isset($menu->title_image) && !empty($menu->title_image))
                                <img width="100px" height="40px" src="{{ asset('frontend_assets/images/title/' . $menu->title_image) }}" alt="Title Image">
                              @endif
                            </td>
                            <td>
                              <label class="switch">
                                <input type="checkbox" class="status_check" @if ($menu->is_active == 1) checked @endif data-user-id="{{ $menu->id }}">
                                <span class="slider round"></span>
                              </label>
                            </td>
                            <td class="d-flex justify-content-center" style="gap: 5px;">
                              <a class="btn btn-primary btn-sm" href="{{ route('front.edit', $menu->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                              <button class="btn btn-danger btn-sm btnDeleteMenu" data-id="{{ $menu->id }}">
                                <i class="fa fa-trash"></i> </button>
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
      </div>
    </div>
  </section>
</div>
@endsection()
@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
</script>
<script type="text/javascript">
  $(document).ready(function() {
    // Initialize DataTable
    $('#example').DataTable();

    // Function to update serial numbers
    function updateSerialNumbers() {
      $('#example tbody tr').each(function(index) {
        $(this).find('td').first().text(index + 1); // Assuming the serial number is in the first column
      });
    }

    // Changing Status with event delegation
    let changeStatusUrl = "{{ route('frontmenu.status') }}";
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
              text: "User Status Has been Changed!",
              animation: false,
              customClass: 'animated pulse',
              type: 'success',
            });
          }
        }
      })
    });

    // Delete Front Menu with event delegation
    $(document).on('click', '.btnDeleteMenu', function() {
      var frontmenu = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");
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
            url: '/admin/frontmenu/' + frontmenu,
            method: 'DELETE',
            dataType: 'json',
            data: {
              "frontmenu": frontmenu,
              "_token": token,
            },
            success: function(res) {
              if (res.unauthorized == true) {
                swal('Error!', 'No rights To Delete Front Menu', 'error');
              }
              if (res.status) {
                row.remove();
                updateSerialNumbers(); // Update serial numbers after row removal
                swal('Updated!', 'Front Menu deleted', 'success');
              }
            },
            error: function(jhxr, status, err) {
              console.log(jhxr);
            }
          })
        }
      })
    });

    // Sorting Data
    let sortTable = $("#sortfrontMenu");
    let sortingFrontUrl = "{{ route('sort.front.menu') }}";
    let csrfToken = $(".csrf_token");
    var editUrlFront = "{{ route('front.edit') }}";
    $(sortTable).sortable({
      update: function(event, ui) {
        var SortIds = $(this).find('.order-id').map(function() {
          return $(this).val().trim();
        }).get();
        // Getting The Order id of each sortIds
        $(this).find('.order-id').each(function(index) {
          $(this).text(SortIds[index]);
        });
        //Sending Ajax to update the sort ids and change the data sorting
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
                        <td>${index + 1 }
                        <input type="hidden" class="order-id" value="${value.id}">
                        </td>
                        <td >${value.menu}</td>
                        <td>${value.slug}</td>
                        <td>${value.page_title}</td>
                        <td>${value.tagline}</td>
                        <td> <img width="100px" height="40px" src="{{ asset('frontend_assets/images/title/') }}/${value.title_image}" alt="service logo" /></td>
                        <td>
                  <label class="switch">
                    <input type="checkbox" class="status_check" ${value.is_active == 1 ? 'checked' : ''} data-user-id="${value.id}">
                    <span class="slider round"></span>
                  </label>
                </td>
                <td class="d-flex justify-content-center" style="gap: 5px;">
                              <a class="btn btn-primary btn-sm" href="` + editUrlFront + "/" + value.id + `" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                        <button class="btn btn-danger btn-sm btnDeleteMenu" data-id="${value.id}">
                        <i class="fa fa-trash"></i> </button>
                        </td>
                        </tr>`;
            });
            $(sortTable).html(table);
            updateSerialNumbers(); // Update serial numbers after sorting
          }
        })
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
