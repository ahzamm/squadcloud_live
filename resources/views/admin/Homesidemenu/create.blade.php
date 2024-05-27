@extends('admin.layouts.app')
@push('style')
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
@endpush
@section('content')
@php
$action = $data['action'];
if($action == "create"){
$parentRoute = Route("homeside.store");
$parentTitle = "Create";
}
if($action == "edit"){
$id = $data['homeside']->id ;
$parentRoute = Route("homeside.update" , $id);
$parentTitle = "Update";
}
@endphp
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-address-card"></i></span> {{$parentTitle}} Contact Us </h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('homeside.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{$parentRoute}}" method="POST" id="submitForm" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Email Address <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="email" placeholder="Example : abc@gmail.com" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Contact Number <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="phone" placeholder="Example :  11 11 LOGON " required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Address <span style="color: red">*</span></label>
                    <textarea type="color" class="form-control" name="address" placeholder="Example :  Office No# E-1 " required></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      <input type="checkbox" name="status" id="checkboxSuccess1">
                      <label for="checkboxSuccess1">
                        Status (On & Off) <span style="color: red">*</span>
                      </label>
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
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
</div>
@endsection
@push('scripts')
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('site/sweet-alert/sweetalert2.min.js')}}"></script>
<script>
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
  $(document).ready(function() {
    $('#pageContent').summernote({
      height: 300
    });
  });
  $("#submitForm").submit(function(e) {
    if ($('input[name="email"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Email is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
    if ($('input[name="phone"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Phone Number is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
    if ($('textarea[name="address"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Address is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
  });
  let action = "{{$action}}";
  let socialData = <?php echo isset($data['homeside']) && $data['homeside']  ? $data['homeside'] : 0 ?>;
  if (action == "edit") {
    $('textarea[name="address"]').val(socialData.address);
    $('input[name="email"]').val(socialData.email);
    $('input[name="phone"]').val(socialData.phone);
    let status = socialData.status == "1" ? "on" : "off";
    status == "on" ? $('input[name="status"]').prop('checked', true) : $('input[name="status"]').prop('checked', false);
  }
</script>
@endpush