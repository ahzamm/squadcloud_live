@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update Portfolio</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('portfolios.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('portfolios.update',$portfolio->id)}}" method="POST" id="updatePortfolioForm" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Portfolio Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="title" value="{{old('title') == NULL ? $portfolio->title : old('title')}}">
                    @error('title')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Description <span style="color: red">*</span></label>
                    <textarea name="description" rows="4" class="form-control summernote">{{$portfolio->description}}</textarea>
                    @error('description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Link <span style="color: red">*</span></label>
                    <input type="url" class="form-control" name="link" value="{{old('link') == NULL ? $portfolio->link : old('link')}}">
                    @error('link')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
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
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Route <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="route" value="{{old('route') == NULL ? $portfolio->route : old('route')}}">
                    @error('route')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Rating <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="rating" value="{{old('rating') == NULL ? $portfolio->rating : old('rating')}}">
                    @error('rating')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Rating Number<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="rating_number" value="{{old('rating_number') == NULL ? $portfolio->rating_number : old('rating_number')}}">
                    @error('rating_number')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Price<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="price" value="{{old('price') == NULL ? $portfolio->price : old('price')}}">
                    @error('price')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Price Description<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="price_description" value="{{old('price_description') == NULL ? $portfolio->price_description : old('price_description')}}">
                    @error('price_description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    @php
                    $images = explode('","', $portfolio->images);
                    $images = str_ireplace(array( '\'', '"',',' , ';', '<', '>' ,'[',']',), ' ', $images);
                    @endphp

                    <label for="">Upload Screenshots <span style="color: red">*</span></label>
                    <table class="table table-bordered" id="dynamicTable">
                      <tr>
                        <td colspan="7">
                        <input type="hidden" name="imagesToDelete" id="imagesToDelete">
                        @foreach ($portfolio->images as $image)
                        <div class="image-container" data-image-key="{{ $image->id }}">
                          <img src="{{ asset('frontend_assets/images/portfolio/' . $image->images) }}" height="60" width="120" alt="" class="mb-3">
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
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
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
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group clearfix">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" {{ $portfolio->is_active == 1 ? 'checked' : '' }} name="status" id="checkboxSuccess1">
                      <label for="checkboxSuccess1">
                        Status (On & Off)
                      </label>
                    </div>
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
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
@endsection
@push('scripts')
<script>
  $(document).ready(function(){
    $('.summernote').summernote({
      height: 300
    });
  });
</script>
<script type="text/javascript">
    var i = 0;
    $("#add").click(function(){
      ++i;
      $html = '<tr><td colspan="7"><input type="file" name="images[]" class="image-input dynamic-input" /></td><td colspan="3"><button type="button" class="btn btn-danger remove-tr">X</button></td></tr>';
      $("#dynamicTable").append($html);
    });
    $(document).on('click', '.remove-tr', function(){
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
        return false; // Exit the loop if an invalid file type is found
      }
    } else {
      valid = false;
      imageError.text('All image fields must have a selected file.').show();
      return false; // Exit the loop if an empty field is found
    }
  });

  if (!valid) {
    e.preventDefault(); // Prevent form submission if validation fails
  }
});




});
 </script>
@endpush
