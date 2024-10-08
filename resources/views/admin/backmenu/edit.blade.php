@extends('admin.layouts.app')
@push('style')
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('site/sweet-alert/sweetalert2.css') }}">
@endpush
@section('content')
@section('title', 'Edit Menu')
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-user-shield"></i></span> Update Admin Menu</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{ route('menus.index') }}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <div class="row mt-5 justify-content-center">
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="card" style="border-color: rgb(126, 120, 120);">
                <div class="card-header">
                  <h5 class="card-title">Modify Main Menu and SubMenu</h5>
                </div>
                <div class="card-body">
                  <form action="{{ route('menus.update', $menus->id) }}" method="POST" id="AddMenusForm">
                    @csrf
                    <input type="hidden" name="deletedSubmenus" id="deletedSubmenus" value="">

                    <div class="row">
                      <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label>Main Menu Name <span style="color: red">*</span></label>
                          <input name="parentMenu" type="text" class="form-control" value="{{ $menus->menu }}" placeholder="Example : About Us">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="">Select Icon <span style="color: red">*</span></label>
                          <select name="menuicon" class="form-control" id="selectIcon">
                            <option value></option>
                            @foreach ($icons as $item)
                              <option value="{{ $item }}" {{ $item == $menus->icon ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                          </select>
                          @error('icon')
                            <p class="text-danger mt-2 mb-0 text-sm">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>SubMenu Name <span style="color: red">*</span></th>
                              <th>SubMenu Route <span style="color: red">*</span></th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody id="submenu-list">
                            @foreach ($menus->submenus as $key => $item)
                              <tr>
                                <td class="d-none">
                                  <input type="hidden" name="submenuId[]" value="{{ $item->id }}" />
                                </td>
                                <td class="td-first">
                                  <input type="" name="submenu[]" value="{{ $item->submenu }}" placeholder="Example : View Detail" class="form-control" />
                                </td>
                                <td class="td-second">
                                  <input type="" name="submenuroute[]" value="{{ $item->route_name }}" placeholder="Example : viewdetail.index" class="form-control" />
                                  <span class="text-danger text-sm d-none">Route name not exist in database</span>
                                </td>
                                <td>
                                  <button class="btn btn-danger btn-sm my-1 btnDeleteSubMenu" type="button" data-delete="true">
                                    <i class="fa fa-trash"></i>
                                  </button>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <a class="btn btn-outline-secondary btn-sm float-right ml-2" href="{{ route('menus.index') }}">Cancel</a>
                          <button class="btn btn-outline-primary btn-sm float-right" type="submit" id="menuBtn">Update Menu</button>
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
      <input type="" name="submenu[]" placeholder="Sub Menu Name" class="form-control"/>
    </td>
    <td class="td-second">
      <input type="" name="submenuroute[]" placeholder="Sub Menu Route" class="form-control"/>
      <span class="text-danger text-sm d-none">Route name not exist in database</span>
    </td>
    <td><button class="btn btn-danger btn-sm my-1 btnDeleteSubMenu" type="button" data-delete="true">
        <i class="fa fa-trash"></i>
    </button></td>
  </tr>
</script>
@endsection
@push('scripts')
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('site/sweet-alert/sweetalert2.min.js') }}"></script>
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

  function formatState(state) {
    if (!state.id) {
      return state.text;
    }
    var $state = $(
      "<i class='" + state.element.value + "''></i> <span style='color:black;margin-left:10px'>" + state.element.value + "</span>"
    );
    return $state;
  }
  $(function() {
    $('.selectList').select2({
      theme: 'bootstrap4'
    })
    $('#selectIcon').select2({
      theme: 'bootstrap4',
      templateResult: formatState,
      templateSelection: formatState
    });
    $('.select2.select2-container').css('width', 'auto');
  })

  function checkinput(input) {
    if (input.val() == "") {
      $(input).css('border', '1px solid red');
      return false;
    } else {
      $(input).css('border', '1px solid #444951');
      return true;
    }
    $(document).on('click', '#btnAddSubMenu', function() {
      let dataRow = $('#data-row').html();
      $('#submenu-list').append(dataRow);
    });
  }
  $(document).on('click', '.btnDeleteSubMenu', function() {
    let submenuId = $(this).closest('tr').find('input[name="submenuId[]"]').val();
    if (submenuId !== '0') {
      // Mark submenu for deletion by adding its ID to an array
      let deletedSubmenus = $('#deletedSubmenus').val().split(',').filter(Boolean);
      deletedSubmenus.push(submenuId);
      $('#deletedSubmenus').val(deletedSubmenus.join(','));
    }

    // Remove the row visually
    $(this).closest('tr').remove();
  });
</script>
@endpush
