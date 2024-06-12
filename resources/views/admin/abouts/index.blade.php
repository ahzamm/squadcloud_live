@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-box-open"></i></span> Update About Page</h3>
          </div>
          <form action="{{route('about.update')}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Description <span style="color: red">*</span></label>
                      <textarea class="form-control summernote" name="description"  rows="4">{{$about->description}}</textarea>
                      @error('description')
                      <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Video URL <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="video_url"  value="{{old('video_url') == NULL?$about->video_url:old('video_url') }}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Closing Remarks <span style="color: red">*</span></label>
                    <textarea class="form-control summernote" name="closing_remarks"  rows="4">{{$about->closing_remarks}}</textarea>
                    @error('closing_remarks')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>




                <div class="col-md-4">
                    <div class="form-group">
                      @php
                      $image = explode('","',$about->images);
                      $image= str_ireplace( array( '\'', '"',',' , ';', '<', '>' ,'[',']',), ' ', $image);
                      for($i=0; $i < Count($image); $i++)
                      {
                        $ages = $image[$i];
                      }
                      @endphp


                      <label for="">Upload Image <span style="color: red">*</span></label>
                      <table class="table table-bordered" id="dynamicTable">
                        <tr>
                          <td colspan="7">
                          <input type="hidden" name="imagesToDelete" id="imagesToDelete">
                            @php
                              $images = json_decode($about->images, true) ?? [];
                            @endphp
                            @foreach ($images as $key => $image)
                              <div class="image-container" data-image-key="{{ $key }}">
                                <img src="{{ asset('frontend_assets/images/abouts/' . trim($image)) }}" height="60" width="120" alt="" class="mb-3">
                                <button type="button" class="btn btn-danger delete-image-btn">Delete</button>
                              </div>
                            @endforeach
                            <input type="file" class="form-control-file" name="images[]" id="image-about">
                            <td colspan="3">
                              <button type="button" name="addmore[0][add]" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                            </td>
                          </tr>
                        </table>
                        @error('image')
                        <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
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
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
@endsection
@push('scripts')
<script>
  $(document).ready(function(){
    $('#pageContent').summernote({
      height:300
    });
  });
</script>
<script type="text/javascript">
    var i = 0;
    $("#add").click(function(){
      ++i;
      $html = '<tr><td colspan="7"><input type="file" name="images[]" class="" /></td><td colspan="3"><button type="button" class="btn btn-danger remove-tr">X</button></td></tr>';
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

$('#updateAboutUsForm').submit(function() {
  // Remove empty file inputs before submitting the form
  $(this).find('input[type="file"]').each(function() {
    if (!$(this).val()) {
      $(this).remove();
    }
  });
  });
});
 </script>
@endpush
