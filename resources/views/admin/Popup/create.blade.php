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
$parentRoute = Route("popup.store");
$parentTitle = "Create";
}
if($action == "edit"){
$id = $data['popup']->id ;
$parentRoute = Route("popup.update" , $id);
$parentTitle = "Edit";
}
@endphp
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info mt-2">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-comment-dots"></i></span> {{$parentTitle}} PoPup</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="{{route('popup.index')}}">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
          <form action="{{$parentRoute}}" method="POST" id="submitForm" enctype="multipart/form-data">
            <!-- /.card-header -->
            <div class="card-body pad">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Upload PopUp Image <span style="color: red">*</span></label>
                    <input type="file" class="form-control" name="image" onchange="validateImageSize(this)">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">PopUp Start (YY-MM-DD) <span style="color: red">*</span></label>
                    <input type="date" class="form-control" name="s_date">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">PopUp Start Time <span style="color: red">*</span></label>
                    <input type="time" class="form-control" name="s_Time">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">PopUp End (YY-MM-DD) <span style="color: red">*</span></label>
                    <input type="date" class="form-control" name="e_date">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">PopUp End Time <span style="color: red">*</span></label>
                    <input type="time" class="form-control" name="e_Time">
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
 $('input[name="image"]').on('change' , function(e){
  e.preventDefault();
  let filename = $(this).val();
  let fileExtension = filename.split('.').pop();
  let ValidExtension = ['Jpeg' , 'jpg' , 'Png' , 'png' ,"JPG"]
  if(!ValidExtension.includes(fileExtension.toLowerCase())){
    swal({
      title: 'File Extension Not supported!',
      text: 'Supported Files are Jpeg , Jpg and Png !',
      animation: false,
      customClass: 'animated pulse',
      type: 'error',
    });
    $(this).val("")
  }
  else{
    let file = e.target.files[0];
    // Check if a file is selected
    if (file) {
      let fileSizeInBytes = file.size;
      let fileSizeInKB = fileSizeInBytes / 1024;
      let fileSizeInMB = fileSizeInKB / 1024;
      if(fileSizeInMB > 2){
        swal({
          title: 'File Size Exceeds!',
          text: 'File size exceeds 2MB. Please select a smaller file.!',
          animation: false,
          customClass: 'animated pulse',
          type: 'error',
        });
        $(this).val("")
      }
    }
  }
})
 let action = "{{$action}}";
 $("#submitForm").submit(function(e) {
   if(action == "create"){
    if ($('input[name="image"]').val() == "") {
      e.preventDefault();
      swal({
        title: 'You are missing Something!',
        text: "Pop Up Image is required!",
        animation: false,
        customClass: 'animated pulse',
        type: 'error',
      })
      return false;
    }
  }
  var startDate = $('input[name="s_date"]').val();
  var startTime = $('input[name="s_Time"]').val();
  var endDate = $('input[name="e_date"]').val();
  var endTime = $('input[name="e_Time"]').val();
  var startDateTime = new Date(startDate + ' ' + startTime);
  var endDateTime = new Date(endDate + ' ' + endTime);
  if (endDateTime <= startDateTime) {
    e.preventDefault();
    swal({
      title: 'Invalid Date/Time!',
      text: 'End date/time should be after the start date/time!',
      animation: false,
      customClass: 'animated pulse',
      type: 'error',
    });
    return false;
  }
  if ($('input[name="s_date"]').val() == "") {
    e.preventDefault();
    swal({
      title: 'You are missing Something!',
      text: "Start Date is required!",
      animation: false,
      customClass: 'animated pulse',
      type: 'error',
    })
    return false;
  }
  if ($('input[name="s_Time"]').val() == "") {
    e.preventDefault();
    swal({
      title: 'You are missing Something!',
      text: "Start Time is required!",
      animation: false,
      customClass: 'animated pulse',
      type: 'error',
    })
    return false;
  }
  if ($('input[name="date"]').val() == "") {
    e.preventDefault();
    swal({
      title: 'You are missing Something!',
      text: "End Date is required!",
      animation: false,
      customClass: 'animated pulse',
      type: 'error',
    })
    return false;
  }
  if ($('input[name="e_Time"]').val() == "") {
    e.preventDefault();
    swal({
      title: 'You are missing Something!',
      text: "End Time is required!",
      animation: false,
      customClass: 'animated pulse',
      type: 'error',
    })
    return false;
  }
});
 let socialData = <?php echo isset($data['popup']) && $data['popup']  ? $data['popup'] : 0 ?>;
 if (action == "edit") {
  $('input[name="s_date"]').val(socialData.start_date);
  $('input[name="s_Time"]').val(socialData.start_time);
  $('input[name="e_date"]').val(socialData.end_date);
  $('input[name="e_Time"]').val(socialData.end_time);
}
</script>

<script>
  function validateImageSize(input) {
    if (input.files && input.files[0]) {
        var img = new Image();
        img.src = window.URL.createObjectURL(input.files[0]);
        img.onload = function () {
            if (this.width != 500 || this.height != 500) {
              swal({
                  title: 'Image Size Issue',
                  text: "Please upload an image with dimensions 500px x 500px.",
                  animation: false,
                  customClass: 'animated pulse',
                  type: 'error',
                })
                // alert("Please upload an image with dimensions 500px x 500px.");
                input.value = ''; // Clear input field
            }
        };
    }
}
</script>
@endpush
