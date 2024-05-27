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
 <link rel="stylesheet" href="<?php echo e(asset('site/css/pe-icon-7-stroke.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/responsive-lightbox/assets/nivo/nivo-lightbox.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/responsive-lightbox/assets/nivo/themes/default/default.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/revslider/public/assets/css/settings.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/bootstrap.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/owl-carousel/owl.carousel.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/owl-carousel/owl.theme.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/style.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/responsive.css').'?ver=all'); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/animations.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/mega-menu.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/mega-menu-responsive.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/fontawesome-free/css/all.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/fontawesome-free/css/brands.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/fontawesome-free/css/fontawesome.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/fontawesome-free/css/regular.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/fontawesome-free/css/solid.min.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('site/css/offcanvasmenu.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/nanoscroller.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/hover.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/thickbox/thickbox.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/css/js_composer.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/css-skin.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/lib/bower/vcIconPicker/css/jquery.fonticonpicker.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/lib/bower/vcIconPicker/themes/grey-theme/jquery.fonticonpicker.vcgrey.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/css/lib/vc-open-iconic/vc_openiconic.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/css/lib/typicons/src/font/typicons.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/css/lib/vc-entypo/vc_entypo.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/css/lib/vc-linecons/vc_linecons_icons.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/css/lib/monosocialiconsfont/monosocialiconsfont.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/css/lib/vc-material/vc_material.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/lib/bower/animate-css/animate.min.css')); ?>" type="text/css" media="screen" />
 <link rel="stylesheet" href="<?php echo e(asset('site/js/plugins/js_composer/assets/css/js_composer_tta.min.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/slick.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/slick-theme.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/custom-style.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/css/zoom-slider.css')); ?>" type="text/css" media="all" />
 <link rel="stylesheet" href="<?php echo e(asset('site/sweet-alert/sweetalert2.css')); ?>">
 <?php
 $frontSettings = \App\Models\Logo::where('active' , 1)->first();
 ?>
 <link rel="icon" href="<?php echo e(asset('small-front-logo/' . $frontSettings->small_image)); ?>" sizes="32x32" />
 <link rel="icon" href="<?php echo e(asset('small-front-logo/' . $frontSettings->small_image)); ?>" sizes="192x192" />
 <link rel="apple-touch-icon-precomposed" href="<?php echo e(asset('small-front-logo/' . $frontSettings->small_image)); ?>" />
 <!-- Swiper JS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
 <meta name="msapplication-TileImage" content="<?php echo e(asset('small-front-logo/' . $frontSettings->small_image)); ?>" />
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito%3A400%2C700%26subset%3Dlatin%7CPoppins%3A300%2C300italic%2C400%2C400italic%2C600%2C600italic%26subset%3Dlatin%7CPoppins%3A300%2C400%2C600%26subset%3Dlatin&amp;ver=1.0" type="text/css" media="all" />
 <link href="https://fonts.googleapis.com/css?family=Nunito:400%2C300%2C200%2C500%7CPoppins:300%7COpen+Sans:300" rel="stylesheet" property="stylesheet" type="text/css" media="all" />
 <?php echo \Livewire\Livewire::styles(); ?>

<!-- Code Finalize --><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/site/partial/style.blade.php ENDPATH**/ ?>