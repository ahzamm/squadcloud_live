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
 @push('style')
 <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
 <link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{asset('sweet-alert/sweetalert2.css')}}">
 @endpush
 @section('content')
 @section('title','Edit Menu')
 <div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><i class="fa-solid fa-bars"></i></span> Front Menu</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('frontmenu.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <div class="card-header">
            <div class="row mt-5 justify-content-center">
              <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="card" style="border-color: rgb(126, 120, 120);">
                  <div class="card-header">
                    <h5 class="card-title">Update Main Menu</h5>
                  </div>
                  <div class="card-body">              
                    <form action="{{route('frontmenu.update',$menus->id)}}" method="POST" id="AddMenusForm">
                      @method('PUT')
                      @csrf
                      <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Main Menu Name <span style="color: red">*</span></label>
                            <input name="parentMenu" type="text" class="form-control" placeholder="Example : Contact Us" value="{{$menus->menu}}" required>
                          </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>Main Menu (ID)<span style="color: red">*</span></label>
                            <input name="menu_id" type="text" class="form-control" placeholder="Example : Contact Us" value="{{$menus->menu_id}}" required>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <a class="btn btn-outline-secondary btn-sm float-right ml-2" href="{{route('frontmenu.index')}}">Cancel</a>
                            <button class="btn btn-outline-primary btn-sm float-right" type="submit" id="menuBtn">Update</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/html" id="data-row">
  <tr>
    <td class="d-none">
      <input type="hidden" name="submenuId[]" value="0"/>
    </td>
    <td class="td-first">
      <input type="" name="submenu[]" placeholder="Sub Menu Name" class="form-control" required/>
    </td>
    <td class="td-second">
      <input type="" name="submenuroute[]" placeholder="Sub Menu Route" class="form-control" required/>
      <span class="text-danger text-sm d-none">Route name not exist in database</span>
    </td>
    <td><button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button></td>
  </tr>
</script>
@endsection
@push('scripts')
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('sweet-alert/sweetalert2.min.js')}}"></script>
<script>
  $(function(){
    $('.selectList').select2({
      theme: 'bootstrap4'
    })
    $('#selectIcon').select2({
      theme: 'bootstrap4',
      templateResult: formatState,
      templateSelection: formatState
    });
    $('.select2.select2-container').css('width','auto');
  })
  function checkinput(input)
  {
    if(input.val() == "")
    {
      $(input).css('border','1px solid red');
      return false;
    }
    else
    {
      $(input).css('border','1px solid #444951');
      return true;
    }
  }
</script>
@endpush
<!-- Code Finalize -->