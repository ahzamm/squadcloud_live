@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-pencil"></i></span> Add About Us</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('aboutus.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('aboutus.store')}}" method="POST" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description">Description <span style="color: red">*</span></label>
                    <textarea class="form-control summernote" name="description" value="{{old('description')}}" id="summernote" placeholder="Description add here."></textarea>
                    @error('description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Upload Image <span style="color: red">*</span></label>
                    <table class="table table-bordered" id="dynamicTable"> 
                      <tr><td colspan="2">
                        <input type="file" class="form-control-file" name="images[]" id="image-about"></td>
                        <td colspan="3">
                          <button type="button" name="addmore[0][add]" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                        </td>
                      </tr>
                    </table>
                    @error('images')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                  </div></div>                 
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary float-right">Submit</button>
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
  <script type="text/javascript">
    var i = 0;
    $("#add").click(function(){
      ++i;
      $html = '<tr><td colspan="3"><input type="file" name="images[]" class="" /></td><td colspan="2"><button type="button" class="btn btn-danger remove-tr ml-1">X</button></td></tr>';
      $("#dynamicTable").append($html);
    });
    $(document).on('click', '.remove-tr', function(){  
     $(this).parents('tr').remove();
   });  
 </script>
 @if(Session::has("success"))
 <script>
  swal({
    title: 'Success!',
    text: "{{Session::get('success')}}",
    animation: false,
    customClass: 'animated pulse',
    type: 'success',   
  });
</script>
@endif
@if(Session::has("error"))
<script>
  swal({
    title: 'Error!',
    text: '{{Session::get("error")}}',
    animation: false,
    customClass: 'animated pulse',
    type: 'error',
  });
</script>
@endif
@endpush