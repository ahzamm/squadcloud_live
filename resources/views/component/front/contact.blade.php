<style>
  .captcha-box {
    text-align: center;
  }

  .captcha {
    margin-bottom: 20px;
  }

  .numbers span {
    margin: 0 5px;
    font-size: 24px;
    cursor: pointer;
  }

  button {
    padding: 12px 20px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s;
  }

  button:hover {
    background-color: #45a049;
  }

  .fa-refresh {
    color: #22a638;
  }

  /* Add your existing CSS styles here */
  /* Popup styles */
  .popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    z-index: 9999;
  }

  .overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.1);
    /* Adjust the alpha value here */
    z-index: 9998;
  }
</style>
<div role="form" class="wpcf7" id="wpcf7-f2869-p19-o1" lang="en-US" dir="ltr">
  @if (session()->has('message'))
    <div class="screen-reader-response">{{ session()->get('message') }}</div>
  @endif
  {{-- <form  wire:submit.prevent="submit"> --}}
  <form class="contact-form" action="{{ route('site.contact.request') }}" method="post" id="contactForm">
    @csrf
    <div class="row mb-3">
      <div class="col" data-aos="fade-right" data-aos-duration="1000">
        <span class="icon-box"><i class="fa fa-user"></i></span>
        <input type="text" id="full_name" class="form-control name" name="full_name" value="{{ old('full_name') }}" placeholder="Good Name *">
        <span class="error-message" id="name-error">This field is required</span>
      </div>
      <div class="col" data-aos="fade-left" data-aos-duration="1000">
        <span class="icon-box"><i class="fa fa-envelope"></i></span>
        <input type="text" id="email" class="form-control email" name="email" value="{{ old('email') }}" placeholder="Email Address *">
        <span class="error-message" id="email-error">This field is required</span>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col" data-aos="fade-right" data-aos-duration="1000">
        <span class="icon-box"><i class="fa fa-phone"></i></span>
        <input type="text" id="phone_number" class="form-control phone" name="phone" value="{{ old('phone') }}" placeholder="Contact Number *">
        <span class="error-message" id="phone-error">This field is required</span>
      </div>
      <div class="col" data-aos="fade-left" data-aos-duration="1000">
        <span class="icon-box"><i class="fa fa-list"></i></span>
        <input type="text" id="service_required" class="form-control service" name="service_required" value="{{ old('service_required') }}" placeholder="Required Service *">
        <span class="error-message" id="service-error">This field is required</span>
      </div>
    </div>
    <div class="row" style="margin-top: 25px; z-index: 9;">
      <div class="col position-relative" data-aos="fade-up" data-aos-duration="1000">
        <div class="textarea-overlay"></div>

        <textarea class="form-control custom-textarea" name="message" id="message" cols="30" rows="5" style="">{{ old('message') }} </textarea>
        <span class="textarea-placeholder">Write Here</span>
        <span class="error-message" id="message-error">This field is required</span>
        <div class="d-flex align-items-center justify-content-center">
          <button type="submit" id="send" value="send me" class="contact-now-btn" style="">Contact Now</button>
        </div>
      </div>
    </div>
  </form>
  <div class="popup" id="captchaPopup">
    <button class="mb-3" style="color: black!important; background:transparent!important;float:right;" onclick="closecaptcha()">X</button>
    <div class="clearfix"></div>
    <div class="captcha-box">
      <div class="captcha">
        <p>Please solve the addition:</p>
        <div class="numbers">
          <span id="captchaAnswer">0</span>
          <span>+</span>
          <span id="captchaAnswer2">5</span>
          <span><i class="fa fa-refresh" aria-hidden="true" onclick="refreshCaptcha()"></i></span>
        </div>
        <form id="captchaForm">
          <input type="text" id="resultAnswer" placeholder="Your answer">
          <button type="submit" id="captchaSubmit">Submit</button>
          <p id="result"></p>
      </div>
    </div>
    </form>
  </div>
</div>
<script></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="{{ asset('sweet-alert/sweetalert2.min.js') }}"></script>
<script>
  function closecaptcha() {
    document.getElementById('captchaPopup').style.display = 'none';
    document.querySelector('.overlay').style.display = 'none';
    $("#resultAnswer").val("");
  }

  // Function to refresh the CAPTCHA numbers
  function refreshCaptcha() {
    const num1 = Math.floor(Math.random() * 10);
    const num2 = Math.floor(Math.random() * 10);
    document.getElementById('captchaAnswer').textContent = num1;
    document.getElementById('captchaAnswer2').textContent = num2;
  }

  let contactFormLink = "{{ route('user.contact') }}";

  $("#contactForm").submit(function(e) {
    let isValid = true;
    if ($('#full_name').val() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are missing Something!',
        text: "First and Last Name is Required!",
        animation: false,
        type: 'error',
      });
      isValid = false;
      return false;
    }
    if ($('#email').val() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are missing Something!',
        text: "Email Address is Required!",
        animation: false,
        type: 'error',
      });
      isValid = false;
      return false;
    }
    if ($('#phone_number').val() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are missing Something!',
        text: "Phone Number is Required!",
        animation: false,
        type: 'error',
      });
      isValid = false;
    }
    if ($('#service_required').val() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are Missing Something!',
        text: "Service is Required!",
        animation: false,
        icon: 'error',
      });
      isValid = false;
    }
    if ($('#message').val().trim() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are Missing Something!',
        text: "Message is Required!",
        animation: false,
        icon: 'error',
      });
      isValid = false;
    }

    if (isValid == true) {
      e.preventDefault();
      const num1 = Math.floor(Math.random() * 10);
      const num2 = Math.floor(Math.random() * 10);
      document.getElementById('captchaAnswer').textContent = num1;
      document.getElementById('captchaAnswer2').textContent = num2;
      $("#captchaPopup").fadeIn();
    }
  });

  $("#captchaForm").submit(function(e) {
    e.preventDefault(); // Always prevent the default form submission
    let answerInput = $("#resultAnswer");
    if ($(answerInput).val() == "") {
      Swal.fire({
        title: 'You Are missing Something!',
        text: "Captcha Verification is Required!",
        animation: false,
        type: 'error',
      });
      return false;
    }
    let number1 = parseInt($("#captchaAnswer").text());
    let number2 = parseInt($("#captchaAnswer2").text());
    let answer = number1 + number2;
    if (answer != parseInt(answerInput.val())) {
      Swal.fire({
        title: 'Incorrect Captcha!',
        text: "Captcha Verification Failed Try Again!",
        animation: false,
        type: 'error',
      });
      refreshCaptcha();
      return false;
    }
    if (answer == parseInt(answerInput.val())) {
      Swal.fire({
        title: 'Captcha Verified!',
        text: "Captcha Verification Successful!",
        animation: false,
        type: 'success',
      });
      $("#captchaPopup").fadeOut();
      $("#sendFormButton").text("Sending Request....");

      // AJAX call to submit the form data
      $.ajax({
        url: contactFormLink,
        type: 'POST',
        data: $("#contactForm").serialize(),
        success: function(res) {
          console.log(res);
          if (res.status == 'success') {
            Swal.fire({
              title: 'Contact Message Sent!',
              text: "Message For Contact Request has been Sent!",
              type: 'success',
            });
            $('#contactForm')[0].reset();
            $("#resultAnswer").val("");
            $("#sendFormButton").text("Send");
          } else {
            Swal.fire({
              title: 'Error!',
              text: "Failed to send Contact request!",
              animation: false,
              type: 'error',
            });
          }
        },
        error: function(xhr) {
          if (xhr.status === 422) {
            var errors = xhr.responseJSON.errors;
            $.each(errors, function(key, error) {
              $('#' + key).addClass('error');
              $('#' + key + '-error').text(error[0]).show();
            });
          } else {
            Swal.fire({
              title: 'Error!',
              text: 'An unexpected error occurred. Please try again later.',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        }
      });
    }
  });
</script>
