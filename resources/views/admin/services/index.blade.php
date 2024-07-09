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
                          <td>{{ $item->is_active == 1 ? 'active' : 'deactive' }}</td>
                          <td class="d-flex justify-content-center" style="gap: 5px;">
                            <a class="btn btn-primary btn-sm" href="{{ route('services.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
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
      $("#sortable").sortable();
      $("#sortable").disableSelection();
    });
  </script>
  <script>
    let packageDeleteUrl = "{{ route('service.destroy') }}";
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
          console.log("Delete URL : " + packageDeleteUrl + '/' + id)
          $.ajax({
            url: packageDeleteUrl + '/' + id,
            method: 'get',
            dataType: 'json',
            success: function(res) {
              if (res.unauthorized) {
                swal('Error!', 'No Rights To delete Service', "error");
              }
              if (res.status) {
                swal('Updated!', 'Service deleted', 'success');
                location.reload();
              }
            },
            error: function(jhxr, status, err) {
              console.log(jhxr);
            }
          })
        } else {
          swal('Error!', 'Something Went Wrong', "error");
        }
      })
    })
    //delete menu end
    function validateEmail(email) {
      const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
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
        url: '/admin/services/' + id,
        dataType: 'html',
        success: function(res) {
          $('#frontPagesModal').find('.modal-content').html(res);
        }
      })
    })


    let sortTable = $("#sortfrontMenu");
    let sortingFrontUrl = "{{ route('sort.service') }}";
    let csrfToken = $(".csrf_token");
    var editUrlFront = "{{ route('service.edit') }}";
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
                  <td >${value.service}</td>
                  <td> <img width="40px" height="40px" src="{{ asset('frontend_assets/images/services/') }}/${value.logo}" alt="service logo" /></td>
                  <td>${value.tagline}</td>
                  <td>${value.slug}</td>
                  <td> <img width="40px" height="40px" src="{{ asset('frontend_assets/images/services/') }}/${value.background_image}" alt="service logo" /></td>
                  <td>${value.is_active == 1?'active':'deactive'}</td>
                  <td>
                  <a href="` + editUrlFront + "/" + value.id + `" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                  <button class="btn btn-danger btn-sm deleteRecord" data-id="${value.id}">
                  <i class="fa fa-trash"></i> </button>
                  </td>
                  </tr>`;
            });
            $(sortTable).html(table);
          }
        })
      }
    });
  </script>
@endpush
