@extends('admin.layouts.app')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title mb-0"><i class="fa-solid fa-images"></i></span> Update Home (Slider)</h3>
              <div class="ml-auto">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('homeslider.index') }}">
                  <i class="fa fa-arrow-left"></i> Back
                </a>
              </div>
            </div>
            @if (isset($homeslider->images) && !empty($homeslider->images))
              {{-- IMAGE FORM --}}
              <form action="{{ route('homeslider.update', $homeslider->id) }}" method="POST" enctype="multipart/form-data">
                <div class="card-body pad">
                  @method('PUT')
                  @csrf
                  <div class="row">
                    <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                        <label for="">Heading <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="heading" value="{{ old('heading') == null ? $homeslider->heading : old('heading') }}">
                        @error('heading')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                        <label for="">Subheading <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="subheading" value="{{ old('subheading') == null ? $homeslider->subheading : old('subheading') }}">
                        @error('subheading')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                        <label for="">Description <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="description" value="{{ old('description') == null ? $homeslider->description : old('description') }}">
                        @error('description')
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                      <div class="form-group">
                        @php
                          $image = explode('","', $homeslider->images);
                          $image = str_ireplace(['\'', '"', ',', ';', '<', '>', '[', ']'], ' ', $image);
                          for ($i = 0; $i < Count($image); $i++) {
                              $ages = $image[$i];
                          }
                        @endphp


                        <label for="">Upload Image <span style="color: red">*</span></label>
                        <table class="table table-bordered" id="dynamicTable">
                          <tr>
                            <td colspan="7">
                              <input type="hidden" name="imagesToDelete" id="imagesToDelete">
                              @php
                                $images = json_decode($homeslider->images, true) ?? [];
                              @endphp
                              @foreach ($images as $key => $image)
                                <div class="image-container" data-image-key="{{ $key }}">
                                  <img src="{{ asset('frontend_assets/images/home_sliders/' . trim($image)) }}" height="60" width="120" alt="" class="mb-3">
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
                          <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-outline-primary float-right">Update</button>
        </div>
        </form>
      @else
        {{-- VIDEO FORM --}}
        <form action="{{ route('homesliders.updatevideo', $homeslider->id) }}" method="POST" enctype="multipart/form-data">
          <div class="card-body pad">
            @method('PUT')
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Upload Video <span style="color: red">*</span></label> <br>
                  @if (isset($homeslider))
                    <video controls width="200" class="mt-3 mb-3">
                      <source src="{{ asset('VideoHeader/' . $homeslider->video) }}" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    <input type="file" class="form-control-file" name="video" id="video">
                  @else
                    <input type="file" class="form-control-file" name="video" id="video">
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group clearfix">
                  <label for="" style="visibility: hidden">A</label>
                  <div class="icheck-success d-block">
                    <input type="checkbox" {{ $homeslider->is_active == 1 ? 'checked' : 'unchecked' }} name="is_active" id="checkboxSuccess2">
                    <label for="checkboxSuccess2">
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
        @endif
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
      $html = '<tr><td colspan="7"><input type="file" name="images[]" class="" /></td><td colspan="3"><button type="button" class="btn btn-danger remove-tr">X</button></td></tr>';
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
