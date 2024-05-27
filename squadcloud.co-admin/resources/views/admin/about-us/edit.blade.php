<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 @extends('admin.layouts.app')
 @section('content')
 <div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-pencil"></i></span> Update About Us</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('aboutus.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{route('aboutus.update',$abouts_us_edit->id)}}" method="POST" enctype="multipart/form-data">
            <div class="card-body pad">
              @method('PUT')               
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description">Description <span style="color: red">*</span></label>
                    <textarea class="form-control summernote" name="description" value="" rows="4" placeholder="Description add here.">{{$abouts_us_edit->description}}</textarea>
                    @error('description')
                    <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    @php 
                    $image = explode('","',$abouts_us_edit->images);
                    $image= str_ireplace( array( '\'', '"',',' , ';', '<', '>' ,'[',']',), ' ', $image);
                    for($i=0; $i < Count($image); $i++)
                    {
                      $images = $image[$i];
                    }
                    @endphp
                    <label for="">Upload Image <span style="color: red">*</span></label>
                    <table class="table table-bordered" id="dynamicTable"> 
                      <tr>
                        <td colspan="7">
                          <input type="file" class="form-control-file" name="images[]" id="image-about"></td>
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
                  <div class="col-md-4">
                    <div class="form-group">
                    </div></div>                 
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-outline-primary float-right">Update</button>
                </div>   </form>
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
          $html = '<tr><td colspan="7"><input type="file" name="images[]" class="" /></td><td colspan="3"><button type="button" class="btn btn-danger remove-tr">X</button></td></tr>';
          $("#dynamicTable").append($html);
        });
        $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
       });  
     </script>
     @endpush
     <!-- Code Finalize -->