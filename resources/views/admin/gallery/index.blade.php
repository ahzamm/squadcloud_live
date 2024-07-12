@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Gallery Page</h3>
            </div>
            <form id="updateGalleryForm" action="{{ route('gallery.update') }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Upload Images <span style="color: red">*</span></label>
                      <table class="table table-bordered" id="dynamicTable">
                        <tr>
                          <td colspan="7">
                            <input type="hidden" name="imagesToDelete" id="imagesToDelete">
                            @foreach ($gallary as $image)
                              <div class="image-container" data-image-key="{{ $image->id }}">
                                <img src="{{ asset('frontend_assets/images/gallary/' . $image->image) }}" height="60" width="120" alt="" class="mb-3">
                                <button type="button" class="btn btn-danger delete-image-btn">Delete</button>
                              </div>
                            @endforeach
                          <td colspan="3">
                            <button type="button" name="addmore[0][add]" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                          </td>
                        </tr>
                      </table>
                      <p id="image-error" class="text-danger mt-2 mb-0 text-sm" style="display:none;"></p>
                      @error('image')
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
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('scripts')
  <script type="text/javascript">
    var i = 0;
    $("#add").click(function() {
      ++i;
      $html = '<tr><td colspan="7"><input type="file" name="images[]" class="image-input" /></td><td colspan="3"><button type="button" class="btn btn-danger remove-tr">X</button></td></tr>';
      $("#dynamicTable").append($html);
    });
    $(document).on('click', '.remove-tr', function() {
      $(this).parents('tr').remove();
    });

    $(document).ready(function() {
      var imagesToDelete = [];

      $('.delete-image-btn').click(function() {
        var container = $(this).closest('.image-container');
        var imageKey = container.data('image-key');
        imagesToDelete.push(imageKey);
        $('#imagesToDelete').val(imagesToDelete.join(','));
        container.remove();
      });

      $('#updateGalleryForm').submit(function(e) {
        var valid = true;
        var imageInputs = $(this).find('input[type="file"]:visible');
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
    });
  </script>
@endpush
