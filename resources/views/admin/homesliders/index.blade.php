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
                <h3 class="card-title"><span><i class="fa-solid fa-box-open"></i></span> Home Sliders</h3>
                <a class="btn btn-success btn-sm float-right" href="{{ route('homesliders.create') }}"><i class="fa fa-plus"></i> Add Home Slider</a>
              </div>
              <div class="card-body">
                <div class="">
                  <table class="table table-bordered table-striped dt-responsive" id="example1">
                    <thead>
                      <tr>
                        <!-- <th>Sort</th> -->
                        <th>Serial#</th>
                        <th>Heading</th>
                        <th>Subheading</th>
                        <th>Description</th>
                        <th>Image / Video</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <input type="hidden" class="csrf_token" value="{{ csrf_token() }}">
                    <tbody id="sortfrontMenu" class="move">
                      @foreach ($homesliders as $key => $item)
                        <tr class="table-row">
                          <td>{{ $key + 1 }}<input type="hidden" class="order-id"value="{{ $item->id }}"></td>
                          <td>
                            @if (isset($item->heading))
                              {{ $item->heading }}
                            @endif
                          </td>
                          <td>
                            @if (isset($item->subheading))
                              {{ $item->subheading }}
                            @endif
                          </td>
                          <td>
                            @if (isset($item->description))
                              {{ $item->description }}
                            @endif
                          </td>
                          <td>
                            @if (isset($item->images) && !empty($item->images))
                              @php
                                $images = json_decode($item->images, true);
                              @endphp
                              @foreach ($images as $index => $image)
                                <img width="60px" height="40px" src="{{ asset('frontend_assets/images/home_sliders/' . $image) }}" />
                                @if ($index < count($images) - 1)
                                  <span style="font-size: 24px; font-weight: bold; margin: 0 10px;">|</span>
                                @endif
                              @endforeach
                            @elseif(isset($item->video))
                              <video controls width="200" height="120">
                                <source src="{{ asset('frontend_assets/images/home_sliders/' . $item->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                              </video>
                            @endif
                          </td>
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_check" @if ($item->is_active == 1) checked @endif data-user-id="{{ $item->id }}">
                              <span class="slider round"></span>
                            </label>
                          </td>
                          <td class="d-flex justify-content-center" style="gap: 5px;">
                            <a class="btn btn-primary btn-sm" href="{{ route('homesliders.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
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
    $(document).ready(function() {
      // Initialize DataTable
      $('#example1').DataTable({
        "responsive": true
      });

      // Changing Status with event delegation
      let changeStatusUrl = "{{ route('homeslider.status') }}";
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

      // Delete HomeSlider with event delegation
      let packageDeleteUrl = "{{ route('homeslider.destroy') }}";
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
      });

      // Sorting Data
      let sortTable = $("#sortfrontMenu");
      let sortingFrontUrl = "{{ route('sort.homeslider') }}";
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
                table += `<tr class="table-row">
                          <td>${index + 1 }
                          <input type="hidden" class="order-id" value="${value.id}">
                          </td>
                          <td>${value.heading ? value.heading : ''}</td>
                          <td>${value.subheading ? value.subheading : ''}</td>
                          <td>${value.description ? value.description : ''}</td>
                          <td>`;
                if (value.images) {
                  let images = JSON.parse(value.images);
                  images.forEach((image, idx) => {
                    table += `<img width="60px" height="40px" src="{{ asset('frontend_assets/images/home_sliders/') }}/${image}" />`;
                    if (idx < images.length - 1) {
                      table += `<span style="font-size: 24px; font-weight: bold; margin: 0 10px;">|</span>`;
                    }
                  });
                } else if (value.video) {
                  table += `<video controls width="200" height="120">
                                    <source src="{{ asset('frontend_assets/images/home_sliders/') }}/${value.video}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>`;
                }
                table += `</td>
                <td>
              <label class="switch">
                <input type="checkbox" class="status_check" ${value.is_active == 1 ? 'checked' : ''} data-user-id="${value.id}">
                <span class="slider round"></span>
              </label>
            </td>
                          <td class="d-flex justify-content-center" style="gap: 5px;">
                              <a href="${editUrlFront}/${value.id}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                              <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="${value.id}">
                                  <i class="fa fa-trash"></i>
                              </button>
                          </td>
                          </tr>`;
              });
              $(sortTable).html(table);
            }
          });
        }
      });
    });

    // Email validation
    function validateEmail(email) {
      const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }

    // Handle front pages view
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
    });

    // Handle partner emails
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
    });

    // Remove email
    $(document).on('click', '.removeMail', function() {
      $(this).parents('li').remove();
    });

    // Add email
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
    });

    // Update emails
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
  </script>

@endpush
