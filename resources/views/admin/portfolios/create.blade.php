@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info mt-2">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Add Portfolio</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('portfolios.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            <form action="{{ route('portfolios.store') }}" method="POST" id="createPortfolioForm" enctype="multipart/form-data">
              <div class="card-body pad">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Portfolio Title <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="title" placeholder="Example : Bitcoin" required value="{{ old('title') }}">
                      @error('package_name')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for=""> Image <span style="color: red">*</span></label> <br>
                      <input type="file" name="image">
                      @error('package_slider_img')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <textarea name="description" rows="4" placeholder="Example : How are you" class="form-control summernote">{{ old('description') }}</textarea>
                      @error('mbps')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Features <span style="color: red">*</span></label>
                      <textarea name="features" rows="4" placeholder="Example : How are you" class="form-control summernote">{{ old('features') }}</textarea>
                      @error('mbps')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Link <span style="color: red">*</span></label>
                      <input type="url" class="form-control" name="link" placeholder="Example : Green" required value="{{ old('link') }}">
                      @error('color')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Route <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="route" placeholder="Example : Green" required value="{{ old('route') }}">
                      @error('color')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Rating <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="rating" placeholder="Example : Green" required value="{{ old('rating') }}">
                      @error('color')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Rating Numbers <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="rating_number" placeholder="Example : Green" required value="{{ old('rating_number') }}">
                      @error('color')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Price <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="price" placeholder="Example : Green" required value="{{ old('price') }}">
                      @error('color')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Price Description <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="price_description" placeholder="Example : Green" required value="{{ old('price_description') }}">
                      @error('color')
                        <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">

                      <label for="">Upload Screenshots <span style="color: red">*</span></label>
                      <table class="table table-bordered" id="dynamicTable">
                        <tr>
                          <td colspan="7">
                            <input type="hidden" name="imagesToDelete" id="imagesToDelete">
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
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary float-right">Submit</button>
          </div>
          </form>
        </div>
      </div>
  </div>
  </section>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function() {
      $('#pageContent').summernote({
        height: 300
      });
    });
  </script>
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

      $('#createPortfolioForm').submit(function(e) {
        var valid = true;
        var imageInputs = $(this).find('input[name="images[]"]:visible');
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
