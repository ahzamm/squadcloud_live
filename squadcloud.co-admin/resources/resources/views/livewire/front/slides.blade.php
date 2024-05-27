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
 @php
 $slide=array();
 $title = array();
 $count = 0;
 foreach($slides as $key => $image) {
 array_push($slide,'"/homeslider/'.$image->image.'"');
 $title[$count] = $image->slogan;
 $custom = implode(',',$slide);
 $count++;
}
$numElements = count($title);
@endphp
<div id="demo-1" data-zs-src='[{{$custom}}]' data-zs-overlay="dots" data-zs-interval="4000" class="slider-zoom zoom-default zoom-style-default zoom-origin-center-center ltx-zs-overlay-black-gloss bullets-false zoom-content-effect-fade-top zoom-margin-top zs-enabled" data-zs-overlay="black-gloss">
 <div class="demo-inner-content">
   <?php 
   for ($i = 0; $i < $numElements; $i++) { ?>
    <p class="zs-description zs-<?= $i ?>" data-slide-index="<?= $i ?>"></p>
  <?php } ?>
</div>
</div>
<!-- Code Finalize -->