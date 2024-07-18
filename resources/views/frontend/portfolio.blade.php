@extends('layouts/frontend')
@section('page_title', $portfolio_menu->page_title)
@section('home_select', 'active')
@section('content')

  <style>
    body {
      height: 100vh;
    }

    header#main-header {
      background: rgb(100 5 15) !important;
    }

    section#our-portfolio {
      padding-top: 150px;
      min-height: calc(100vh - 36px);
    }

    .product-list img {
      height: 100%;
      width: 100%;
      object-fit: cover;
      border-radius: 7px;
    }

    .product-list p {
      font-style: italic;
      color: #961b04;
      margin-bottom: 0;
    }

    .product-list button {
      display: inline-block;
      width: auto;
      padding: 10px 0;
      border: 1px solid #961b04;
      background: none;
      font-weight: 400;
      border-radius: 50px;
      cursor: pointer;
      color: #961b04;
      flex: 1 1 auto;
    }

    .product-list a:hover,
    .product-list button:hover {
      background: #961b04;
      color: #fff !important;
    }

    .product_container {
      margin: 0 auto 0 auto;
      padding-bottom: 59px;
      width: 90%;
    }

    .product-list {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
      gap: 20px;
    }

    .product-list:has(.product:hover) .product:not(:hover) {
      filter: grayscale(90%) blur(1px);
      opacity: 0.7;
    }

    .product {
      height: 230px;
      border-radius: 10px;
      background-color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: filter 0.1s ease-in-out, opacity 0.1s ease-in-out;
    }

    .product-list .img {
      height: 60%;
      width: 100%;
      flex: 1 0 auto;
    }

    .product-list .info {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      padding: 12px 15px;
    }

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

  <section id="our-portfolio" class="position-relative">
    <div class="our-portfolio-bg"></div>
    <div class="container">
      <div class="title-img d-flex align-items-center justify-content-center flex-column mb-5" data-aos="zoom-in-down">
        <img src="frontend_assets/images/title/{{ $portfolio_menu->title_image }}" alt="" style="width: 50%;">
      </div>
      <div class="product_container">
        <div class="product-list">
          @forelse ($portfolios as $portfolio)
            <div>
              <div class="product" data-price="50">
                <div class="img">
                  <img src="{{ asset('frontend_assets/images/portfolio/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                </div>
                <div class="info">
                  <h5>{{ $portfolio->title }}</h5>
                </div>
              </div>
              <div class="product-btns d-flex mt-2" style="column-gap:5px">
                <button><a href="javascript:void(0);" data-job-id="{{ $portfolio->id }}" data-portfolio-title="{{ $portfolio->title }}"
                    onclick="showModal({{ $portfolio->id }}, '{{ $portfolio->title }}')"> Request Demo</a></button>
                <button> <a href="/portfolio/{{ $portfolio->route }}">More Info</a></button>
              </div>
            </div>
          @empty
            <div class="alert alert-danger">No Record Found!</div>
          @endforelse
        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal" id="applyModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="applyModalLabel">Request Demo for <span id="portfolio-title"></span></h5>
          <button type="button" class="close" aria-label="Close" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form id="applyForm" action="{{ route('site.portfolio.post') }}" method="POST" enctype="multipart/form-data">
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
            <input type="hidden" id="job-id" name="portfolio_id" value="">
            <button type="button" class="btn-primary" id="applyNowButton">Apply Now</button>
            <button type="submit" class="btn-primary" id="submitButton" style="display: none;">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('sweet-alert/sweetalert2.min.js') }}"></script>
  <script>
    function refreshCaptcha() {
      const num1 = Math.floor(Math.random() * 10);
      const num2 = Math.floor(Math.random() * 10);
      document.getElementById('captchaAnswer').textContent = num1;
      document.getElementById('captchaAnswer2').textContent = num2;
    }

    function showModal(jobId, title) {
      $('#job-id').val(jobId);
      $('#portfolio-title').text(title);
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
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(($('#applicant-email').val()))) {
        e.preventDefault();
        Swal.fire({
          title: 'Invalid Email!',
          text: 'Please enter a valid email address.',
          icon: 'error',
          toast: true,
          position: 'top-right'
        });
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      @if (session('success'))
        Swal.fire({
          title: 'Success!',
          text: "{{ session('success') }}",
          icon: 'success',
          toast: true,
          position: 'top-right'
        });
        <?php session()->forget('success'); ?>
      @endif

      @if (session('error'))
        Swal.fire({
          title: 'Error!',
          text: "{{ session('error') }}",
          icon: 'error',
          toast: true,
          position: 'top-right'
        });
        <?php session()->forget('error'); ?>
      @endif
    });
  </script>

@endsection
