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
                <h3 class="card-title"><span><i class="fa-solid fa-box-open"></i></span> FAQs</h3>
                <a class="btn btn-success btn-sm float-right ml-2 btnAddCategory">Add FAQ Categories</a>
                <a class="btn btn-success btn-sm float-right" href="{{ route('faqs.index') }}"> <i class="fa fa-arrow-left"></i> Back</a>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="example1">
                    <thead>
                      <tr>
                        <th>Sort</th>
                        <th>Serial#</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <input type="hidden" class="csrf_token" value="{{ csrf_token() }}">
                    <tbody id="sortfrontMenu" class="move">
                      @foreach ($faq_categories as $key => $item)
                        <tr class="table-row">
                          <td><i class="fas fa-sort" id="sort-serial"></i></td>
                          <td>{{ $key + 1 }}<input type="hidden" class="order-id"value="{{ $item->id }}"></td>
                          <td>{{ $item->category }}</td>
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_check" @if ($item->is_active == 1) checked @endif data-user-id="{{ $item->id }}">
                              <span class="slider round"></span>
                            </label>
                          </td>
                          <td class="d-flex justify-content-center" style="gap: 5px;">
                            <a class="btn btn-primary btn-sm btnEditCategory" data-id="{{ $item->id }}" data-category="{{ $item->category }}" data-is_active="{{ $item->is_active }}"><i
                                class="fa fa-edit"></i></a>
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
  <!-- Modal -->
  <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="applyModalLabel">Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
          <form id="categoryForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">
            <div class="form-group">
              <label for="category-name">Category</label>
              <input type="text" id="category-name" name="category" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
          </form>
        </div>
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
  <script>
    var storeRoute = "{{ route('faq_categories.store') }}";
    var updateRoute = "{{ route('faq_categories.update', ':id') }}";

    function showAddModal() {
      $('#categoryModal').modal('show');
      $('#categoryForm').attr('action', storeRoute);
      $('#formMethod').val('POST');
      $('#category-name').val('');
      $('#checkboxSuccess1').prop('checked', false); // Ensure checkbox is unchecked when adding
    }

    function showEditModal(id, category, isActive) {
      $('#categoryModal').modal('show');

      // Replace the placeholder with the actual ID
      var actionUrl = updateRoute.replace(':id', id);

      $('#categoryForm').attr('action', actionUrl);
      $('#formMethod').val('PUT');
      $('#category-name').val(category);
      $('#checkboxSuccess1').prop('checked', isActive); // Set checkbox based on isActive value
    }

    $(document).on('click', '.btnAddCategory', function() {
      showAddModal();
    });

    $(document).on('click', '.btnEditCategory', function() {
      const id = $(this).data('id');
      const category = $(this).data('category');
      const isActive = $(this).data('is_active'); // Get is_active value
      showEditModal(id, category, isActive);
    });

    // Changing Status with event delegation
    let changeStatusUrl = "{{ route('faq_category.status') }}";
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

    // Delete
    let packageDeleteUrl = "{{ route('faq_category.destroy') }}";
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
                swal('Error!', 'No Rights To delete Category', "error");
              }
              if (res.status) {
                $(row).parents('tr').remove();
                swal('Updated!', 'Category deleted', 'success');
              }
            },
            error: function(jhxr, status, err) {
              console.log(jhxr);
            }
          })
        }
      })
    })
    //delete menu end
    function validateEmail(email) {
      const re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }
    $(function() {
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
        url: '/admin/front-pages/' + id,
        dataType: 'html',
        success: function(res) {
          $('#frontPagesModal').find('.modal-content').html(res);
        }
      })
    })
    $(document).on('click', '#emailEditP, #emailEditC', function() {
      $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
            </div>`);
      valFlag = $(this).attr('data-value');
      $.ajax({
        method: 'get',
        url: '/admin/partner-emails/' + valFlag,
        dataType: 'html',
        success: function(res) {
          $('#frontPagesModal').find('.modal-content').html(res);
        },
        error: function(jhxr, err, status) {
          console.log(jhxr);
        }
      })
    })
    $(document).on('click', '.removeMail', function() {
      $(this).parents('li').remove();
    });
    $(document).on('click', '#addEmail', function() {
      email = $('#email').val();
      if (email != '' && validateEmail(email)) {
        $('.todo-list').append(`<li>
              <span class="text">${email}</span>
              <span class="float-right removeMail" style="cursor: pointer">
              <i class="fas fa-times"></i>
              </span>
              <input type="hidden" name="emails[]" value="${email}">
              </li>`);
        $('#email').removeClass('is-invalid').val('');
      } else {
        $('#email').addClass('is-invalid')
      }
    })
    // changeContactEmail
    $(document).on('click', '#updateEmails', function() {
      $.ajax({
        url: "/admin/partner-emails",
        type: "POST",
        data: new FormData(document.forms.namedItem("changeContactEmail")),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        beforeSend: function() {},
        success: function(res) {
          if (res.status) {
            $('#frontPagesModal').modal('hide');
            toastr.info('Emails Updated Successfully');
          }
        },
        error: function(jhxr, status, err) {
          console.log(jhxr);
        },
        complete: function() {}
      });
    });
    // Delete Function
  </script>
  <script>
    $(document).on('click', '.viewFrontPages', function() {
      $('#frontPagesModal').modal('show').find('.modal-content').html(`<div class="modal-body">
            <div class="overlay text-center"><i class="fas fa-2x fa-sync-alt fa-spin text-light"></i></div>
        </div>`);
      id = $(this).attr('data-value');
      $.ajax({
        method: 'get',
        url: '/admin/jobs/' + id,
        dataType: 'html',
        success: function(res) {
          $('#frontPagesModal').find('.modal-content').html(res);
        }
      })
    });

    let sortTable = $("#sortfrontMenu");
    let sortingFrontUrl = "{{ route('sort.faq_category') }}";
    let csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get CSRF token from meta tag

    $(sortTable).sortable({
      update: function(event, ui) {
        var SortIds = $(this).find('.order-id').map(function() {
          return $(this).val().trim();
        }).get();

        $.ajax({
          url: sortingFrontUrl,
          type: "post",
          data: {
            sort_Ids: SortIds
          },
          headers: {
            "X-CSRF-TOKEN": csrfToken
          },
          success: function(response) {
            updateTable(response);
          },
          error: function(xhr, status, error) {
            console.error(xhr);
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

    function updateTable(data) {
      let table = "";
      $(data).each(function(index, value) {
        table += `<tr class="table-row">
                        <td><i class="fas fa-sort" id="sort-serial"></i></td>
                        <td>${index + 1}<input type="hidden" class="order-id" value="${value.id}"></td>
                        <td>${value.category}</td>
                        <td>
          <label class="switch">
            <input type="checkbox" class="status_check" ${value.is_active == 1 ? 'checked' : ''} data-user-id="${value.id}">
            <span class="slider round"></span>
          </label>
        </td>
                        <td class="d-flex justify-content-center" style="gap: 5px;">
                            <a class="btn btn-primary btn-sm btnEditCategory" data-id="${value.id}" data-category="${value.category}" data-is_active="${value.is_active}"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="${value.id}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>`;
      });
      $(sortTable).html(table);
    }
  </script>
@endpush
