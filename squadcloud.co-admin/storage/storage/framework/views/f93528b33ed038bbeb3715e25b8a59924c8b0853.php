<div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1488988810300">
  <!-- <div style="display: flex;gap: 15px;align-items: center;justify-content: center;flex-wrap: wrap;"> -->
    <div class="package-slider">
    </div>
    <!-- Swiper JS -->
    <style>
      .swiper {
        width: 100%;
        /* padding-top: 50px;
        padding-bottom: 50px; */
      }
      .swiper-slide {
        background-position: center;
        background-size: cover;
        box-shadow: 10px 10px 25px rgba(0, 0, 0, 0.2);
        width: 300px;
        border-radius: 20px;
      }
      .swiper-slide img {
        display: block;
        width: 100%;
      }
      .image-container {
        position: relative;
        overflow: hidden;
        /* Hide overflow content */
        width: 100%;
        /* Ensure full width */
        border-radius: 20px;
      }
      .image-title {
        position: absolute;
        font-weight: 900;
        top: -30px;
        left: 0;
        font-size: 24px;
        width: 100%;
        color: #000 !important;
        background-color: rgb(215 215 215);
        margin: 0;
        text-align: center;
        box-sizing: border-box;
        font-family: sans-serif
        /* Include padding in the width */
      }
      @media  screen and (max-width: 600px) {
        .swiper-slide {
          width: 200px;
        }
      }
    </style>
    <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <?php $__currentLoopData = $sindh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="swiper-slide">
          <div class="image-container">
            <h3 class="image-title"><?php echo e($item->name); ?></h3>
            <img src="<?php echo e(url('slider_images/' . $item->package_slider_img)); ?>" alt="<?php echo e($item->name); ?>" style="object-fit: cover; width: 100%; height: 100%;" />
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(empty($sindh)): ?>
        <div class="swiper-slide">
          <p class="text-center">No bundle offer at this time.</p>
        </div>
        <?php endif; ?>
      </div>
      <!-- <div class="swiper-pagination"></div> -->
    </div>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
     var swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      initialSlide: 3
    });
  </script>
  <!-- </div> -->
</div><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/livewire/front/pakage-detail.blade.php ENDPATH**/ ?>