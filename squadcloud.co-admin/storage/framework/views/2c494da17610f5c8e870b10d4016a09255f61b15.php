    <?php
$frontSettings = \App\Models\Logo::where('active' , 1)->first();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="Blink Broadband is Finest and fastest Internet service provider in Karachi, Pakistan and it is powered by LOGON BROADBAND Pvt ltd. We have a spatiality in providing best Fiber optic connection with 100% Fiber optic internet cables and strong Infrastructure of buried fiber for every area of karachi like Clifton, I.I chundigarh road, Shahra -e- faisal, Nazimabad, North Nazimabad, Gulshan, malir, Korangi, FB area and almost every major city in Pakistan, Blink broadband offers the best internet packages in Pakistan. This strong Command on providing fiber optic internet connection makes us one of the best fiber optic internet providers in Pakistan." >
    <title> <?php echo e($frontSettings->title); ?></title>
    <?php echo $__env->make('site.partial.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="home page-template-default page page-id-19 wpb-js-composer js-comp-ver-5.2 vc_responsive">
    <!-- Loader -->
 <div id="loading">
    <div class="position-relative loading-inner">
        <div class="outer one">
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
        </div>
        <div class="outer two">
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
        </div>
        <div class="outer three">
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
        </div>
        <div class="outer four">
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
        </div>
        <div class="outer five">
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
        </div>
        <div class="outer six">
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
        </div>
        <div class="outer seven">
            <div class="square"></div>
            <div class="square"></div>
            <div class="square"></div>
        </div>
        <div class="svg_path">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="7 2 12.5 15">
            <path d="M 10 3 L 13 3 C 18.363 3.068 18.517 8.208 16 9 C 20.188 10.342 18.692 16.093 15 16 L 9 16 C 8 16 8 16 8 15 L 8 9 C 8 8 8 7.998 9 8 L 13 8 C 15.645 8.021 15.911 4.993 13 5 L 10 5 C 9 5 9 5 9 4 C 9 3.001 9 3.001 10 3 M 11.384 14 L 14 14 C 16.12 14.006 16 11 14 11 L 11.376 11.003 C 11.07 11.01 10.986 11.071 10.986 11.411 L 10.987 13.22 C 10.983 13.937 10.934 13.997 11.384 14" stroke="#22a638" stroke-width="0.1" fill="none" class="path"/>
        </svg>
        </div>
    </div>
</div>
<!-- loader end -->
<!-- Mobile sidenav start-->
<div id="mobileSidenav" class="mobileSidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#home" onclick="closeNav()"><span>Home</span></a> 
    <a href="#bundle-offers" onclick="closeNav()"><span>Bundle Offer</span></a> 
    <a href="#team" onclick="closeNav()"><span>Resellers</span></a> 
    <a href="#about-us" onclick="closeNav()"><span>About Us</span></a> 
    <a href="#why-choose-us" onclick="closeNav()"><span>Why Us</span></a> 
    <a href="javascript:void(0)" onclick="showModal()" id="get__modal"><span>Get Services</span></a> 
    <a href="#contact" onclick="closeNav()"><span>Contact Us</span></a> 
    <a href="#faqs" onclick="closeNav()"><span>FAQs</span></a>
</div>
<!-- Mobile Sidenave end -->
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('site.partial.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/site/layout/app.blade.php ENDPATH**/ ?>