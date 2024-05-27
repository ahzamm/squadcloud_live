
<!doctype html>
<html lang="en">
  <head>
    <title>Logon Broadband | Internet Service Provider</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            background-image: url(<?php echo e(URL::asset('site/images/background/maintenance.jpg')); ?>);
            /* background-color: #6c4ec7; */
        }
        .counter-div
        {
            position: relative;
            z-index: 1;
            width: 100%;
            min-height: 100vh;
            background-color: rgba(108, 78, 199,0.7);
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
        .description
        {
            font-weight: lighter;
            font-family: 'Times New Roman', Times, serif;
            font-size: 24px;
            text-transform: none;
        }
    </style>
</head>
  <body>
      <div class="slider">

      </div>
      <div class="counter-div d-flex flex-column justify-content-center">
          <p class="text-center"><img src="<?php echo e(asset('site/upload/logo-min.png')); ?>" class="img-fluid" width="250" alt="404 page not found"></p>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 titleDiv text-center">
                    <h1 id="days">404</h1>
                    <p class="description py-5 text-center">The page you are looking for does not exist. How you got here is a mystery. But you can click the button below to go back to the homepage.</p>
                    <a href="<?php echo e(route('home')); ?>" class="btn btn-light">Home Page</a>
                </div>
            </div>
        </div>
      </div>
</body>
</html><?php /**PATH /www/wwwroot/blinkbroadband.pk/vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/views/404.blade.php ENDPATH**/ ?>