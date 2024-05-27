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
 <!DOCTYPE html>
 <html lang="en">
 @php
 $frontSettings = \App\Models\Logo::where('active' , 1)->first();
 @endphp
 <head>
    <title>{{$frontSettings->title}}</title>
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('small-front-logo' , $frontSettings->small_image)}}" sizes="32x32" />
    <link rel="icon" href="{{asset('small-front-logo' , $frontSettings->small_image)}}" sizes="192x192" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        *{
            color: white;
        }
        html,body,.slider{
            height: 100%;
            width: 100%;
            background-color: white;
        }
        .slider
        {
            display: block;
            position: fixed;
            z-index: 0;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image: url(https://blinkbroadband.pk/site/img/Q2KBDFBujC_1608959945.jpg);
            background-size:cover;
            /* background-color: #6c4ec7; */
        }
        .counter-div
        {
            position: relative;
            z-index: 1;
            width: 100%;
            min-height: 100vh;
            background-color: rgba(108, 78, 199,0.4);
        }
        .titleDiv>h1
        {
            font-family: Poppins-Black;
            font-size: 120px;
            line-height: 1;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
        }
        .titleDiv>p
        {
            text-transform: uppercase;
            font-weight: bold;
            padding-left: 10px
        }
        .description
        {
            font-weight: lighter;
            font-family: 'Times New Roman', Times, serif;
            font-size: 24px;
        }
        .description>a
        {
            color: aqua;
            text-decoration: underline;
        }
        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) { 
            .company-head
            {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 40px;
                line-height: 1;
                color: #fff;
                text-transform: uppercase;
            }
        }
        /* // Medium devices (tablets, 768px and up) */
        @media (min-width: 768px) { 
            .company-head
            {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 80px;
                line-height: 1;
                color: #fff;
                text-transform: uppercase;
            }
        }
        /* // Large devices (desktops, 992px and up) */
        @media (min-width: 992px) { 
        }
        /* // Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) { 
        }
    </style>
</head>
<body>
  <div class="slider">
  </div>
  <div class="counter-div d-flex flex-column justify-content-center">
      <p class="text-center"><img src="https://blinkbroadband.pk/site/upload/logo-min.png" class="img-fluid" width="250" alt=""></p>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 col-sm-3 titleDiv text-center">
                <h1 id="days">00</h1>
                <p>DAYS</p>
            </div>
            <div class="col-6 col-sm-3 titleDiv text-center">
                <h1 id="hours">00</h1>
                <p>HOURS</p>
            </div>
            <div class="col-6 col-sm-3 titleDiv text-center">
                <h1 id="minutes">00</h1>
                <p>MINUTES</p>
            </div>
            <div class="col-6 col-sm-3 titleDiv text-center">
                <h1 id="seconds">00</h1>
                <p>SECONDS</p>
            </div>
        </div>
        <p class="description py-5 text-center">Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always <a href="mailto:info@sparkbraodband.pk">contact us</a>, otherwise we&rsquo;ll be back online shortly!</p>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    var dateOfMaintanence  =  "{{$checkMaintenenace->time}}";
    console.log(dateOfMaintanence);
        // Set the date we're counting down to
        var countDownDate = new Date(dateOfMaintanence).getTime();
        // Nov 20, 2020 00:00:00
        // Update the count down every 1 second
        var x = setInterval(function() {
          // Get today's date and time
          var now = new Date().getTime();
          // Find the distance between now and the count down date
          var distance = countDownDate - now;
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          // Output the result in an element with id="demo"
        //   document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        //   + minutes + "m " + seconds + "s ";
        document.getElementById('days').innerHTML = days;
        document.getElementById('hours').innerHTML = hours;
        document.getElementById('minutes').innerHTML = minutes;
        document.getElementById('seconds').innerHTML = seconds;
          // If the count down is over, write some text 
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
</body>
</html>