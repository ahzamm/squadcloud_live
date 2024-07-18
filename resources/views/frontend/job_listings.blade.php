<style>
  .modal-content {
    background-color: #fefefe;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .modal-header,
  .modal-body {
    padding: 10px 20px;
  }

  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
  }

  .modal-title {
    font-size: 1.5em;
    margin: 0;
  }

  .close {
    background: none;
    border: none;
    font-size: 1.5em;
    cursor: pointer;
  }

  .form-group {
    margin-bottom: 1.5em;
  }

  .form-group label {
    display: block;
    margin-bottom: 0.5em;
    font-weight: bold;
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 0.5em;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .btn-primary {
    display: inline-block;
    padding: 0.5em 1em;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  /* Add captcha popup styles */
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

  .overlay_popup {
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

  .fa-refresh {
    color: #22a638;
  }

  .captcha button {
    padding: 12px 20px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s;
  }

  .captcha button:hover {
    background-color: #45a049;
  }
</style>

<ul class="cat-list">
  <li><a href="" class="filter-button" data-employment-type="View All">View All</a></li>
  <li><a href="" class="filter-button" data-employment-type="Full Time">Full Time</a></li>
  <li><a href="" class="filter-button" data-employment-type="Intern">Intern</a></li>
  <li><a href="" class="filter-button" data-employment-type="Part Time">Part Time</a></li>
</ul>
@foreach ($jobs as $job)
  <div class="single-post d-flex flex-row">
    <div class="thumb">
      <ul class="tags">
        @foreach (explode(',', $job->tags) as $tag)
          <li><a>{{ $tag }}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="details">
      <div class="title d-flex flex-row justify-content-between">
        <div class="titles">
          <a>
            <h4>{{ $job->job_title }}</h4>
          </a>
          <h6>{{ $job->company }}</h6>
        </div>
        <ul class="btns">
          <li><a href="javascript:void(0);" class="apply-button" data-job-id="{{ $job->id }}" onclick="showModal({{ $job->id }})"><i class="fa fa-paper-plane"></i> Apply Now</a></li>
        </ul>
      </div>
      <p>
        {!! $job->job_description !!}
      </p>
      <p><i class="fa fa-copy"></i> Job Nature: {{ $job->employment_type }}</p>
      <p class="address"><i class="fa fa-map-marker-alt"></i> {{ $job->location }}</p>
      <p class="address"><i class="fa fa-money-bill-alt"></i> {{ $job->salary_range }}</p>
    </div>
  </div>
@endforeach

<!-- Modal -->
<div class="modal" id="applyModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="applyModalLabel">Apply Now</h5>
        <button type="button" class="close" aria-label="Close" data-bs-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="applyForm" action="{{ route('site.career.post') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="applicant-name">Good Name</label>
            <input type="text" id="applicant-name" name="name">
          </div>
          <div class="form-group">
            <label for="applicant-email">Email Address</label>
            <input type="email" id="applicant-email" name="email">
          </div>
          <div class="form-group">
            <label for="applicant-phone">Contact Number</label>
            <input type="tel" id="applicant-phone" name="phone">
          </div>
          <div class="form-group">
            <label for="applicant-coverletter">Cover Letter</label>
            <textarea id="applicant-coverletter" name="coverletter" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="applicant-resume">Resume (PDF & Doc)</label>
            <input type="file" id="applicant-resume" name="resume" accept=".pdf,.doc,.docx">
          </div>
          <div class="captcha-box" id="captcha-box" style="display: none;">
            <div class="captcha">
              <p>Please solve the addition:</p>
              <div class="numbers">
                <span id="captchaAnswer">0</span>
                <span>+</span>
                <span id="captchaAnswer2">5</span>
                <span><i class="fa fa-refresh" aria-hidden="true" onclick="refreshCaptcha()"></i></span>
              </div>
              <input type="text" id="resultAnswer" placeholder="Your answer">
              <p id="result"></p>
            </div>
          </div>
          <input type="hidden" id="job-id" name="job_id" value="">
          <button type="button" class="btn-primary" id="applyNowButton">Apply Now</button>
          <button type="submit" class="btn-primary" id="submitButton" style="display: none;">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('sweet-alert/sweetalert2.min.js') }}"></script>
<script>
  function refreshCaptcha() {
    const num1 = Math.floor(Math.random() * 10);
    const num2 = Math.floor(Math.random() * 10);
    document.getElementById('captchaAnswer').textContent = num1;
    document.getElementById('captchaAnswer2').textContent = num2;
  }

  function showModal(jobId) {
    $('#job-id').val(jobId);
    refreshCaptcha();
    $('#applyModal').modal('show');
  }

  $("#applyNowButton").click(function(e) {
    let isValid = true;
    if ($('#applicant-name').val() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are missing Something!',
        text: "Name is Required!",
        icon: 'error',
        toast: true,
        position: 'top-right'
      });
      isValid = false;
      return false;
    }
    if ($('#applicant-email').val() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are missing Something!',
        text: "Email is Required!",
        icon: 'error',
        toast: true,
        position: 'top-right'
      });
      isValid = false;
      return false;
    }
    if ($('#applicant-phone').val() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are missing Something!',
        text: "Phone is Required!",
        icon: 'error',
        toast: true,
        position: 'top-right'
      });
      isValid = false;
      return false;
    }
    if ($('#applicant-coverletter').val().trim() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are Missing Something!',
        text: "Cover Letter is Required!",
        icon: 'error',
        toast: true,
        position: 'top-right'
      });
      isValid = false;
      return false;
    }
    var fileInput = $('#applicant-resume')[0];
    if (fileInput.files.length === 0) {
      e.preventDefault();
      Swal.fire({
        title: 'You Are missing Something!',
        text: "Resume is Required!",
        icon: 'error',
        toast: true,
        position: 'top-right'
      });
      isValid = false;
      return false;
    }
    if (isValid == true) {
      e.preventDefault();
      $('#applyNowButton').hide();
      $('#captcha-box').show();
      $('#submitButton').show();
    }
  });

  $("#submitButton").click(function(e) {
    let answerInput = $("#resultAnswer");
    if ($(answerInput).val() == "") {
      e.preventDefault();
      Swal.fire({
        title: 'You Are missing Something!',
        text: "Captcha Verification is Required!",
        icon: 'error',
        toast: true,
        position: 'top-right'
      });
      return false;
    }
    let number1 = parseInt($("#captchaAnswer").text());
    let number2 = parseInt($("#captchaAnswer2").text());
    let answer = number1 + number2;
    if (answer != parseInt(answerInput.val())) {
      e.preventDefault();
      Swal.fire({
        title: 'Incorrect Captcha!',
        text: "Captcha Verification Failed Try Again!",
        icon: 'error',
        toast: true,
        position: 'top-right'
      });
      refreshCaptcha();
    } else {
      $("#applyForm").unbind('submit').submit();
    }
  });
</script>
