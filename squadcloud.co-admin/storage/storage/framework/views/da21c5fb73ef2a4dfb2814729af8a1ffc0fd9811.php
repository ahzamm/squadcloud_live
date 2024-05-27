    <?php
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
?>
<div id="demo-1" data-zs-src='[<?php echo e($custom); ?>]' data-zs-overlay="dots" data-zs-interval="4000" class="slider-zoom zoom-default zoom-style-default zoom-origin-center-center ltx-zs-overlay-black-gloss bullets-false zoom-content-effect-fade-top zoom-margin-top zs-enabled" data-zs-overlay="black-gloss">
   <div class="demo-inner-content">
       <?php 
       for ($i = 0; $i < $numElements; $i++) { ?>
        <p class="zs-description zs-<?= $i ?>" data-slide-index="<?= $i ?>"></p>
    <?php } ?>
</div>
</div><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/livewire/front/slides.blade.php ENDPATH**/ ?>