<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{asset('site/favicon.png')}}" sizes="32x32" />
  <link rel="icon" href="{{asset('site/favicon.png')}}" sizes="192x192" />
  <title>
    @yield('title')
  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @include('admin.partial.styles')
  @stack('style')
  <link rel="stylesheet" href="{{asset('site/sweet-alert/sweetalert2.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    @include('admin.partial.changepassword')
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> --}}
      </ul>
      <!-- SEARCH FORM -->
      {{-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form> --}}
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        {{-- <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-comments"></i>
              <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="{{asset('admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Brad Diesel
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="{{asset('admin/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      John Pierce
                      <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="{{asset('admin/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Nora Silvester
                      <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">15 Notifications</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
          </li> --}}
          {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li> --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <!-- Icon for user or profile -->
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" data-toggle="modal" data-target="#cvModal"><span><i class="fa-regular fa-address-card"></i></span> User Profile</a>
              <a class="dropdown-item" href="#" id="btnShowCP" role="button" title="Change Password"><span><i class="fas fa-unlock-alt"></i></span> Change Password</a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->
      @include('admin.partial.aside')
      @yield('content')
      <footer class="main-footer">
        <strong>Copyright &copy; 2012 <a href="https://blinkbroadband.pk/" target="_blank">Blink Broadband</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 1.1.0
        </div>
      </footer>
    </div>
    <!-- ./wrapper -->
    <!-- userProfileModel -->
    <!-- The Modal -->
    <div class="modal fade" id="cvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-md modal-sm" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h3>User Profile</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="insertProfile" action="{{route('user.update' , Auth::user()->id )}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Modal Body -->
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <!-- Left Side (Image) -->
                  <div class="col-md-4 col-sm-12 text-center">
                    @php
                    $userProfile  = Auth::user()->image ;
                    @endphp  
                    @if(  $userProfile == null )
                    <img src="https://bestprofilepictures.com/wp-content/uploads/2021/08/Amazing-Profile-Picture-945x1024.jpg" style="height: 220px;object-fit:cover;" alt="Your Name" class="img-fluid img-thumbnail rounded">
                    @else
                    <img src="{{asset('UserProfiles/' . $userProfile )}}" alt="Your Name" class="img-fluid img-thumbnail rounded" style="height: 220px;object-fit:cover;">
                    @endif
                    <input type="file" class="mt-2" name="profileImage">
                  </div>
                  <!-- Right Side (Input Fields) -->
                  <div class="col-md-8 ">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="fullName">User Name</label>
                        <input type="text" class="form-control-plaintext" value="{{Auth::user()->name}}" id="fullName" name="user_name" placeholder="Enter your User Name" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="fullName">First Name</label>
                        <input type="text" class="form-control-plaintext" value="{{Auth::user()->first_name}}" id="firstName" name="first_name" placeholder="Enter your First name" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="fullName">Last Name</label>
                        <input type="text" class="form-control-plaintext" value="{{Auth::user()->last_name}}" id="lastName" name="last_name"  placeholder="Enter your Last name" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control-plaintext" value="{{Auth::user()->email}}" id="email" name="email" placeholder="Enter your email" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email">CNIC Number</label>
                        <input type="number" class="form-control-plaintext" value="{{Auth::user()->cnic}}" id="cnic" name="cnic" placeholder="Enter your Cnic" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="phone">Contact Number</label>
                        <input type="tel" class="form-control-plaintext" value="{{Auth::user()->phone}}" id="phone" name="phone" placeholder="Enter your phone number" readonly>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="department">Department</label>
                        <input type="text" class="form-control-plaintext" value="{{Auth::user()->department}}" id="department" name="department" placeholder="Enter your department" readonly>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="department">Address</label>
                        <input  class="form-control-plaintext" id="address"  value="{{Auth::user()->address}}"  name="address" readonly>
                      </div>
                    </div>
                    <!-- Add more input fields as needed -->
                    <!-- Modal Footer with Save button -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                      <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End of that -->
    @include('admin.partial.scripts')
    @stack('scripts')
    <script>  
     $("#insertProfile").submit(function(e){
      if($('#fullName').val() == ""){
        e.preventDefault();
        swal('You are missing something!' , "User Name is Required" , 'warning');
        return false ;
      }
      if($('#firstName').val() == ""){
        e.preventDefault();
        swal('You are missing something!' , "First Name is Required" , 'warning');
        return false ;
      }
      if($('#lastName').val() == ""){
        e.preventDefault();
        swal('You are missing something!' , "Last Name is Required" , 'warning');
        return false ;
      }
      if($('#email').val() == ""){
        e.preventDefault();
        swal('You are missing something!' , "Email is Required" , 'warning');
        return false ;
      }
      if($('#cnic').val().length < 13 && $("#cnic").val()  != ""){
        e.preventDefault();
        swal('You are missing something!' , "Cnic must be of 13-digits" , 'warning');
        return false ;
      }
      if($('#phone').val() == ""){
        e.preventDefault();
        swal('You are missing something!' , "Phone Number is Required" , 'warning');
        return false ;
      }
      if($('#phone').val().length < 11 && $("#phone").val()  != ""){
        e.preventDefault();
        swal('You are missing something!' , "Phone number must be of 11-digits" , 'warning');
        return false ;
      }
      if($('#department').val() == ""){
        e.preventDefault();
        swal('You are missing something!' , "Department is Required" , 'warning');
        return false ;
      }
      if($('#address').val() == ""){
        e.preventDefault();
        swal('You are missing something!' , "Address is Required" , 'warning');
        return false ;
      }
    });
     function changePasswordErrorMsg(msg, container) {
      $(container).html('<ul style="list-style:none" class="pl-0"></ul>');
      $(container).css('display', 'block');
      $.each(msg, function(key, value) {
        $(container).find("ul").append('<li>' + value + '</li>');
      });
    }
    //CHANGE pASSWORD modal Open
    $('#btnShowCP').click(function() {
      $('#newpassword_confirmation').val('');
      $('#newpassword').val('');
      $('#oldpassword').val('');
      $('#changePassError').css('display', 'none');
      $('#changePasswordModal').modal('show');
    })
    $('#changePassword').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: "{{route('admin.change.password')}}",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        beforeSend: function()
        {
        },
        success: function(data)
        {
          if ($.isEmptyObject(data.error)) {
            if (data.status)
            {
              $('#changePasswordModal').modal('hide');
            }
          } else {
            changePasswordErrorMsg(data.error, "#changePassError");
          }
        },
        error: function(jhxr, status, err) {
          console.log(jhxr);
        },
        complete: function() {
        }
      });
    })



    function openInNewTab(url) {
      window.open(url, '_blank').focus();
    }

    $(document).ready(function() {
      $('.summernote').summernote({
        height: 100
      });
    })
  </script>
</body>
</html>