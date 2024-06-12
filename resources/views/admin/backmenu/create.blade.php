@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@section('content')
@section('title','Add Menu')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-user-shield"></i></span> Create Admin Menu</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('menus.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <div class="row mt-5 justify-content-center">
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="card" style="border-color: rgb(126, 120, 120);">
                <div class="card-body">
                  <form action="{{route('menus.store')}}" method="POST" id="AddMenusForm">
                    @csrf
                    <div class="row">
                      <div class="col-12">
                        <div class="i-checks float-right">
                          <input id="hassubmenu" type="checkbox" value="hassubmenu" name="hassubmenu" data-value="false" checked="" class="checkbox-template">
                          <label for="hassubmenu">Has SubMenus <span style="color: red">*</span></label>
                        </div>
                      </div>
                      <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label>Main Menu Name <span style="color: red">*</span></label>
                          <input name="parentMenu" type="text" class="form-control" placeholder="Example : About Us" value="{{old('parentMenu')}}">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Select Icon <span style="color: red">*</span></label>
                          <select name="menuicon" class="form-control" id="selectIcon">
                            <option value></option>
                            @foreach ($icons as $item)
                            <option value="{{$item}}" {{ old('menuicon') == $item ? 'selected' : '' }}>{{$item}}</option>
                            @endforeach
                          </select>
                          @error('icon')
                          <p class="text-danger mt-2 mb-0 text-sm">{{$message}}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12" id="singleRoute" style="display: none">
                      </div>
                      <div class="col-md-12" id="subRoute">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>SubMenu Name <span style="color: red">*</span></th>
                              <th>SubMenu Route <span style="color: red">*</span></th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody id="submenu-list">
                            @if(old('submenu'))
                                @foreach(old('submenu') as $index => $submenu)
                                    <tr>
                                    <td class="td-first">
                                        <input type="text" name="submenu[]" placeholder="Sub Menu Name" class="form-control" value="{{ old('submenu')[$index] }}"/>
                                    </td>
                                    <td class="td-second">
                                        <input type="text" name="submenuroute[]" placeholder="Sub Menu Route" class="form-control" value="{{ old('submenuroute')[$index] }}"/>
                                        <span class="text-danger text-sm d-none">Route name not exist in database</span>
                                    </td>
                                    <td><button class="btn btn-danger btn-sm my-1 btnDeleteSubMenu" type="button"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                @endforeach
                                @endif

                          </tbody>
                        </table>
                        <button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <a class="btn btn-outline-secondary btn-sm float-right ml-2" href="{{route('menus.index')}}">Cancel</a>
                          <button class="btn btn-outline-primary btn-sm float-right" type="submit" id="menuBtn">Submit</button>
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
      <td class="td-first">
        <input type="text" name="submenu[]" placeholder="Sub Menu Name" class="form-control" value=""/>
      </td>
      <td class="td-second">
        <input type="text" name="submenuroute[]" placeholder="Sub Menu Route" class="form-control" value=""/>
        <span class="text-danger text-sm d-none">Route name not exist in database</span>
      </td>
      <td><button class="btn btn-danger btn-sm my-1 btnDeleteSubMenu" type="button"><i class="fa fa-trash"></i></button></td>
    </tr>
  </script>

  <script>
    function setDefaultValues() {
      $('#submenu-list tr:last-child').find('input[name="submenu[]"]').val('{{ old('submenu') ? old('submenu')[count(old('submenu')) - 1] : '' }}');
      $('#submenu-list tr:last-child').find('input[name="submenuroute[]"]').val('{{ old('submenuroute') ? old('submenuroute')[count(old('submenuroute')) - 1] : '' }}');
    }

    $(document).on('click', '#btnAddSubMenu', function() {
      let dataRow = $('#data-row').html();
      $('#submenu-list').append(dataRow);
      setDefaultValues();
    });

    // Delegate the event for dynamically added elements
    $(document).on('click', '.btnDeleteSubMenu', function() {
      $(this).closest('tr').remove();
    });
  </script>


<script type="text/html" id="singleMenubody">
  <div class="form-group">
    <label>Route Name</label>
    <input name="parentroutename" type="text" class="form-control" value="{{old('parentroutename')}}">
  </div>
</script>
<script type="text/html" id="subMenubody">
  <table class="table">
    <thead>
      <tr>
        <th>Sub Menu Name</th>
        <th>Sub Menu Route</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="submenu-list">
    </tbody>
  </table>
  <button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button>
</script>
@endsection
@push('scripts')
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  function formatState(state) {
    if (!state.id) {
      return state.text;
    }
    var $state = $(
      "<i class='"+state.element.value+"''></i> <span style='color:black;margin-left:10px'>"+state.element.value+"</span>"
    );
    return $state;
  }

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

  function checkinput(input) {
    if (input.val() == "") {
      $(input).css('border', '1px solid red');
      return false;
    } else {
      $(input).css('border', '1px solid #444951');
      return true;
    }
  }

  $(document).on('click', '#btnAddSubMenu', function() {
    let dataRow = $('#data-row').html();
    $('#submenu-list').append(dataRow);
  });

  // Delegate the event for dynamically added elements
  $(document).on('click', '.btnDeleteSubMenu', function() {
    $(this).closest('tr').remove();
  });

  $(document).on('change', '#hassubmenu', function() {
    datavalue = $(this).attr('data-value');
    if (datavalue == "true") {
      $('#singleRoute').css('display', 'none').html("");
      $('#subRoute').css('display', 'block').html($('#subMenubody').html());
      $(this).attr('data-value', false);
    } else {
      $('#singleRoute').css('display', 'block').html($('#singleMenubody').html());;
      $('#subRoute').css('display', 'none').html("");
      $(this).attr('data-value', true);
    }
  });
</script>
@endpush
