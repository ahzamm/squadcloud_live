@extends('admin.layouts.app')
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
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa fa-podcast"></i></span> Update Portfolio</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('portfolios.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('portfolios.update', $portfolio->id) }}" method="POST" id="updatePortfolioForm" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Portfolio Title <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="title" value="{{ old('title') == null ? $portfolio->title : old('title') }}">
                      @error('title')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Link <span style="color: red">*</span></label>
                      <input type="url" class="form-control" name="link" value="{{ old('link') == null ? $portfolio->link : old('link') }}">
                      @error('link')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Route <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="route" value="{{ old('route') == null ? $portfolio->route : old('route') }}">
                      @error('route')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Rating <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="rating" value="{{ old('rating') == null ? $portfolio->rating : old('rating') }}">
                      @error('rating')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Rating Number<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="rating_number" value="{{ old('rating_number') == null ? $portfolio->rating_number : old('rating_number') }}">
                      @error('rating_number')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Price<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="price" value="{{ old('price') == null ? $portfolio->price : old('price') }}">
                      @error('price')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Price Description<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="price_description" value="{{ old('price_description') == null ? $portfolio->price_description : old('price_description') }}">
                      @error('price_description')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Image <span style="color: red">*</span></label> <br>
                      @isset($portfolio->image)
                        <img src="{{ asset('frontend_assets/images/portfolio/' . $portfolio->image) }}" height="60" width="120" alt="" srcset="">
                      @endisset
                      <br><br>
                      <input type="file" name="image">
                      @error('image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Background Image <span style="color: red">*</span></label> <br>
                      @isset($portfolio->background_image)
                        <img src="{{ asset('frontend_assets/images/portfolio/' . $portfolio->background_image) }}" height="60" width="120" alt="" srcset="">
                      @endisset
                      <br><br>
                      <input type="file" name="background_image">
                      @error('background_image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <textarea name="description" rows="4" class="form-control summernote">{{ $portfolio->description }}</textarea>
                      @error('description')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Features <span style="color: red">*</span></label>
                      <textarea name="features" rows="4" class="form-control summernote">{{ $portfolio->features }}</textarea>
                      @error('features')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>


                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary float-right">Update</button>
              </div>
            </form>
            <div class="col-md-12">
              <label for="">Screen Shots <span style="color: red">*</span></label>
              <button type="button" class="btn btn-success btn-sm float-right" id="addImageBtn"><i class="fa fa-plus"></i> Add Image</button>
              <input type="file" id="imageInput" style="display: none;" accept="image/*">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="example">
                    <thead>
                      <tr>
                        <th>Serial#</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <input type="hidden" class="csrf_token" value="{{ csrf_token() }}">
                    <tbody id="sortfrontMenu" class="move">
                      @foreach ($portfolio->images as $key => $item)
                        <tr class="table-row">
                          <td class="serial-number">{{ $key + 1 }}<input type="hidden" class="order-id" value="{{ $item->id }}"></td>
                          <td><img width="60px" height="50px" src="{{ asset('frontend_assets/images/portfolio/' . $item->images) }}" alt="screenshot logo" /></td>
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_check" @if ($item->is_active == 1) checked @endif data-user-id="{{ $item->id }}">
                              <span class="slider round"></span>
                            </label>
                          </td>
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
@endsection
@push('scripts')
  <script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 300
      });
    });
  </script>
  <script type="text/javascript">
    var i = 0;
    $("#add").click(function() {
      ++i;
      $html =
        '<tr><td colspan="7"><input type="file" name="images[]" class="image-input dynamic-input" /></td><td colspan="3"><button type="button" class="btn btn-danger remove-tr">X</button></td></tr>';
      $("#dynamicTable").append($html);
    });
    $(document).on('click', '.remove-tr', function() {
      $(this).parents('tr').remove();
    });

    $(document).ready(function() {
      var portfolioId = {{ $portfolio->id }};
      var imagesToDelete = [];

      $('.delete-image-btn').click(function() {
        var container = $(this).closest('.image-container');
        var imageKey = container.data('image-key');
        imagesToDelete.push(imageKey);
        $('#imagesToDelete').val(imagesToDelete.join(','));
        container.remove();
      });

      $('#updatePortfolioForm').submit(function(e) {
        var valid = true;
        var imageInputs = $(this).find('input.dynamic-input[type="file"]:visible');
        var imageError = $('#image-error');
        imageError.hide();

        imageInputs.each(function() {
          if ($(this).val()) {
            var file = $(this).prop('files')[0];
            var fileType = file.type;
            var validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
            var validFile = validExtensions.includes(fileType.toLowerCase());
            if (!validFile) {
              valid = false;
              imageError.text('Please select only image files (JPEG/JPG/PNG).').show();
              return false;
            }
          } else {
            valid = false;
            imageError.text('All image fields must have a selected file.').show();
            return false;
          }
        });

        if (!valid) {
          e.preventDefault();
        }
      });

      // Sorting Data
      let sortTable = $("#sortfrontMenu");
      let sortingFrontUrl = "{{ route('sort.screenshot') }}";
      let csrfToken = $(".csrf_token").val(); // Get the value directly

      $(sortTable).sortable({
        update: function(event, ui) {
          var SortIds = $(this).find('.order-id').map(function() {
            return $(this).val().trim();
          }).get();

          console.log('Sorted IDs:', SortIds);
          console.log('Portfolio ID:', portfolioId);

          $.ajax({
            url: sortingFrontUrl,
            type: "POST",
            data: {
              sort_Ids: SortIds,
              portfolio_id: portfolioId // Use colon instead of equals sign
            },
            headers: {
              "X-CSRF-TOKEN": csrfToken // Use the value directly
            },
            success: function(response) {
              console.log('AJAX response:', response);
              reloadTableData(response);
            },
            error: function(xhr, status, error) {
              console.log('AJAX error:', error);
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

      function reloadTableData(data) {
        let table = "";
        $(data).each(function(index, value) {
          table += `<tr class="table-row">
            <td>${index + 1}
            <input type="hidden" class="order-id" value="${value.id}">
            </td>
            <td><img width="60px" height="50px" src="{{ asset('frontend_assets/images/portfolio/') }}/${value.images}" alt="service logo" /></td>
            <td>
              <label class="switch">
                <input type="checkbox" class="status_check" ${value.is_active == 1 ? 'checked' : ''} data-user-id="${value.id}">
                <span class="slider round"></span>
              </label>
            </td>
            <td class="d-flex justify-content-center" style="gap: 5px;">
              <button class="btn btn-danger btn-sm btnDeleteMenu" data-value="${value.id}">
                <i class="fa fa-trash"></i>
              </button>
            </td>
          </tr>`;
        });
        $("#sortfrontMenu").html(table);
        // Reinitialize the event handlers
        initializeStatusSwitch();
      }
    });

    // Open file explorer when Add Image button is clicked
    $('#addImageBtn').on('click', function(event) {
      $('#imageInput').click();
    });

    // Handle file selection
    $('#imageInput').on('change', function() {
      var formData = new FormData();
      var file = $(this)[0].files[0];
      formData.append('image', file);
      formData.append('_token', '{{ csrf_token() }}');
      formData.append('portfolio_id', {{ $portfolio->id }});

      $.ajax({
        url: "{{ route('screenshot.store') }}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          if (response.status == 'success') {
            toastr.success('Image uploaded successfully');
            location.reload(); // Reload the page to show the new image
          } else {
            toastr.error('Image upload failed');
          }
        },
        error: function(xhr, status, error) {
          console.log(error);
          toastr.error('An error occurred while uploading the image');
        }
      });
    });

    $(document).on('change', '.status_check', function(e) {
      let currentStatus = $(this).prop('checked') ? 1 : 0;
      var status = $(this);
      e.preventDefault();
      $.ajax({
        url: "{{ route('screenshot.status') }}",
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

    $(document).on('click', '.btnDeleteMenu', function() {
      var id = $(this).attr('data-value');
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
            url: "{{ route('screenshot.delete', '') }}/" + id,
            method: 'get',
            data: {
              "_token": "{{ csrf_token() }}",
            },
            success: function(res) {
              if (res.status) {
                row.remove();
                updateSerialNumbers();
                swal('Deleted!', 'Screenshot deleted successfully.', 'success');
              } else {
                swal('Error!', 'Failed to delete screenshot.', 'error');
              }
            },
            error: function(jqXHR, status, err) {
              swal('Error!', 'Something went wrong.', 'error');
            }
          })
        } else {
          swal('Cancelled', 'The deletion was cancelled.', 'error');
        }
      });
    });


    function updateSerialNumbers() {
      $('#example tbody tr').each(function(index) {
        $(this).find('td').first().text(index + 1);
      });
    }
  </script>
@endpush
