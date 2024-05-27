<script src="<?php echo e(asset('site/sweet-alert/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/brands.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/all.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/regular.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/solid.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/fontawesome.min.js')); ?>"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript">
  document.documentElement.style.overflow = 'hidden';
  $(document).ready(function () {
   setTimeout(
     function() 
     {
      $('#loading').fadeOut();
      $(document.documentElement).css('overflow', 'auto');
    }, 4000);
 });
</script>
<script>
  function openNav() {
    document.getElementById("mobileSidenav").style.width = "250px";
  }
  function closeNav() {
    document.getElementById("mobileSidenav").style.width = "0";
  }
  function showModal() {
    $('#selectionModal').modal('show');
    closeNav();
  }
</script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
<?php if(Session::has('success')): ?>
<script>
  swal({
    title: 'Success!',
    text: "<?php echo e((Session::get('success'))); ?>",
    animation: false,            
    type: 'success',                 
  })
</script>   
<?php endif; ?>
<?php if(Session::has('error')): ?>
<script>
  swal({
    title: 'Error!',
    text: "<?php echo e((Session::get('error'))); ?>",
    animation: false,            
    type: 'error',                 
  })
</script>
<?php endif; ?>
<script>
  function printErrorMsg(msg,container) {
    $(container).html('');
    $(container).css('display','block').css('list-style-type','none');
    $.each( msg, function( key, value ) {
      $(container).append('<li>'+value+'</li>');
    });
  }
  function validateRequired(field)
  {
    if($(field).val() != "")
    {
      $(field).attr('style','');
      return true;
    }
    $(field).css('border','1px red solid');
    return false;
  }
  $(document).on('click','.cityClick',function(){
    $('#selectionModal').modal('show');
    $('#uError').css("display", "none");
    $('#pError').css("display", "none");
    province = $(this).attr('data-value');
    $.getJSON('/site/cities/'+province,function(data){
            // $('#provience').html('');
            // $('#province').append('<option value>Select Cities</option>');
            // $('#province').html('<option selected value="">Select Provience</option>');
            // $('#province').html('<option value="">Select Cities</option>');
            $('#cities').html('<option value="">Select Cities</option>');
            $('#coreareas').html('<option value="">Select Core Area</option>');
            $('#zoneareas').html('<option value="">Select Zone</option>');
            // $.each(data.cities,function(index,item){
            //     $('#cities').append('<option value="'+item.id+'">'+item.name+'</option>');
            // });
          });
//         $.getJSON('/site/cities/' + province, function(data) {
//     // Assuming data is an array of objects with 'id' and 'name' properties
//     data.sort((a, b) => a.name.localeCompare(b.name));
//     // Clear and populate the select dropdown with sorted data
//     $('#cities').html('<option value="">Select Cities</option>');
//     data.forEach(function(item) {
//         $('#cities').append('<option value="' + item.id + '">' + item.name + '</option>');
//     });
//     // Clear other select dropdowns if needed
//     $('#coreareas').html('<option value="">Select Core Area</option>');
//     $('#zoneareas').html('<option value="">Select Zone</option>');
// });
});
  $(document).on('change','#province',function(){
    provienceId = $(this).val();
        // alert(provienceId);
        $.getJSON('/site/cities/'+provienceId,function(data){
          $('#cities').html('');
          $('#coreareas').html('<option value="">Select Core Area</option>');
          $('#zoneareas').html('<option value="">Select Zone</option>');
            // console.log(data);
            $('#cities').append('<option value="">Select City</option>');
            $.each(data.cities,function(index,item){
              $('#cities').append('<option value="'+item.id+'">'+item.name+'</option>');
            });
          });
      })
  $(document).on('change','#cities',function(){
    cityId = $(this).val();
    $.getJSON('/site/corearea/'+cityId,function(data){
            // console.log(data);
            $('#coreareas').html('');
            $('#coreareas').append('<option value>Select Core Area</option>');
            $.each(data.coreareas,function(index,item){
              $('#coreareas').append('<option value="'+item.id+'">'+item.name+'</option>');
            });
          });
  })
  $(document).on('change','#coreareas',function(){
    cityId = $(this).val();
    $.getJSON('/site/zonearea/'+cityId,function(data){
            // console.log(data);
            $('#zoneareas').html('');
            $('#zoneareas').append('<option value>Select Zone</option>');
            $.each(data.zoneareas,function(index,item){
              $('#zoneareas').append('<option value="'+item.id+'">'+item.name+'</option>');
            });
          });
  })
  $(document).on('submit','#selectlocationform',function(e){
    e.preventDefault();
    city = $('#cities');
    corearea = $('#coreareas');
    zonearea = $('#zoneareas');
    if(validateRequired(city) && validateRequired(corearea) && validateRequired(zonearea))
    {
      $('#selectionModal').modal('hide');
      setTimeout(function() {
        $('#messageModal').modal('show');
      }, 500);
    }
  })
  $(document).on('click','#showpartner',function(){
    $('#p_province_id').val($('#province').val());
    $('#p_city_id').val($('#cities').val());
    $('#p_core_area_id').val($('#coreareas').val());
    $('#p_zone_area_id').val($('#zoneareas').val());
    $('.modal').modal('hide');
    setTimeout(function() {
      $('#PartnerModal').modal('show');
      document.getElementById("becomeAPartnerFrm").reset();
    }, 500);
  })
  $(document).on('click','#showuser',function(){
    $('#u_province_id').val($('#province').val());
    $('#u_city_id').val($('#cities').val());
    $('#u_core_area_id').val($('#coreareas').val());
    $('#u_zone_area_id').val($('#zoneareas').val());
    $('.modal').modal('hide');
    setTimeout(function() {
      $('#UserModal').modal('show');
      document.getElementById("becomeAUserFrm").reset();
    }, 500);
  });
  $(document).on('submit','#becomeAPartnerFrm',function(e){
   isValid = true; 
   if($('#p_name').val() == ""){
    e.preventDefault();
    swal("You are Missing Somethings!" , "Name Field is Required" , "warning");
    isValid = false ;
    return false ;
  }
  if($('#p_address').val() == ""){
    e.preventDefault();
    swal("You are Missing Somethings!" , "Address Field is Required" , "warning");
    isValid = false ;
    return false ;
  }
  if($('#p_landmark').val() == ""){
    e.preventDefault();
    swal("You are Missing Somethings!" , "Landmark Field is Required" , "warning");
    isValid = false ;
    return false ;
  }
  if($('#p_number').val() == ""){
    e.preventDefault();
    swal("You are Missing Somethings!" , "Phone Number Field is Required" , "warning");
    isValid = false ;
    return false ;
  }
  if($("#p_number").val().length < 11){
    e.preventDefault();
    swal("Phone Number Digits Exceeds!" , "Phone Number Must be less then 11 digits" , "warning");
    isValid = false ;
    return false ;
  }
  if($('#p_email').val() == ""){
    e.preventDefault();
    swal("You are Missing Somethings!" , "Email Field is Required" , "warning");
    isValid = false ;
    return false ;
  }
  if($('#p_user').val() == ""){
    e.preventDefault();
    swal("You are Missing Somethings!" , "No of Users Field is Required" , "warning");
    isValid = false ;
    return false ;
  }
  if(isValid){
    e.preventDefault();
    const num1 = Math.floor(Math.random() * 10);
    const num2 = Math.floor(Math.random() * 10);
    document.getElementById('num1').textContent = num1;
    document.getElementById('num2').textContent = num2;
    $("#captchaPopupPartner").fadeIn();
    $("#PartnerModal").fadeOut();
  }
});
  let partnerUrl  = "<?php echo e(route('becompartner')); ?>" ;
  $("#captchaFormPartner").submit(function(e){
    isVarified  = true ;
    let answerInput = $("#answer");
    if($(answerInput).val() == ""){
      e.preventDefault();
      isVarified = false ;
      swal({
        title: 'You Are missing Something!',
        text: "Captcha Verification is Required!",
        animation: false,            
        type: 'error',                 
      });
      return false ;
    }
    let number1 = parseInt($("#num1").text()) ;
    let number2 = parseInt($("#num2").text()) ;
    let answer  = number1 + number2 ;
    if(answer != parseInt(answerInput.val())){
      e.preventDefault();
      swal({
        title: 'Incorrect Captcha!',
        text: "Captcha Verification Failed Try Again!",
        animation: false,            
        type: 'error',                 
      });
      const num1 = Math.floor(Math.random() * 10);
      const num2 = Math.floor(Math.random() * 10);
      document.getElementById('num1').textContent = num1;
      document.getElementById('num2').textContent = num2;
    }
    if(answer == parseInt(answerInput.val())){
      e.preventDefault();
      swal({
        title: 'Captcha Verified!',
        text: "Captcha Verification SuccessFull! Sending Coverage Request",
        animation: false,            
        type: 'success',                 
      });
      $("#captchaPopupPartner").fadeOut();
      $.ajax({
        url : partnerUrl , 
        type : 'Post' , 
        data : $("#becomeAPartnerFrm").serialize(),
        success:function(res){
          console.log(res);
          if(res.status == true){
            swal({
              title: 'Coverage Request Sent!',
              text: "Message For Coverage Request as a Partner has been Sent!",
              type: 'success',                 
            },
            );
            $('#becomeAPartnerFrm')[0].reset();
            $("#captchaSubmitPartner").text("Send");
          }
          else
          {
            swal({
              title: 'Error!',
              text: "Failed to send Contact request!",
              animation: false,            
              type: 'error',                 
            });
          }
        }
      })
    }
  });
  $(document).on('submit','#becomeAUserFrm',function(e){
    isValid = true; 
    if($('#u_province_id').val() == ""){
      e.preventDefault();
      swal("You are Missing Somethings!" , "User Province Field is Required" , "warning");
      isValid = false ;
      return false ;
    }
    if($('#u_city_id').val() == ""){
      e.preventDefault();
      swal("You are Missing Somethings!" , "User City Field is Required" , "warning");
      isValid = false ;
      return false ;
    }
    if($('#u_core_area_id').val() == ""){
      e.preventDefault();
      swal("You are Missing Somethings!" , "User Core Area Field is Required" , "warning");
      isValid = false ;
      return false ;
    }
    if($('#u_zone_area_id').val() == ""){
      e.preventDefault();
      swal("You are Missing Somethings!" , "User Zone Area Field is Required" , "warning");
      isValid = false ;
      return false ;
    }
    if($("#name").val() == ""){
      e.preventDefault();
      swal("Phone Number Digits Exceeds!" , "User Name Field is Required" , "warning");
      isValid = false ;
      return false ;
    }
    if($('#address').val() == ""){
      e.preventDefault();
      swal("You are Missing Somethings!" , "User Address field is Required" , "warning");
      isValid = false ;
      return false ;
    }
    if($('#landmark').val() == ""){
      e.preventDefault();
      swal("You are Missing Somethings!" , "User Land mark Field Is Required" , "warning");
      isValid = false ;
      return false ;
    }
    if($("#number").val() == ""){
      e.preventDefault();
      swal("Phone Number Digits Exceeds!" , "Phone Number field is required" , "warning");
      isValid = false ;
      return false ;
    }
    if($("#number").val().length < 11){
      e.preventDefault();
      swal("Phone Number Digits Exceeds!" , "Phone Number Must be less then 11 digits" , "warning");
      isValid = false ;
      return false ;
    }
    if($("#email").val() == ""){
      e.preventDefault();
      swal("Phone Number Digits Exceeds!" , "Email field is required" , "warning");
      isValid = false ;
      return false ;
    }
    if(isValid){
      e.preventDefault();
      const num1 = Math.floor(Math.random() * 10);
      const num2 = Math.floor(Math.random() * 10);
      document.getElementById('usernum1').textContent = num1;
      document.getElementById('usernum2').textContent = num2;
      $("#captchaPopupUser").fadeIn();
      $("#UserModal").fadeOut();
    }
  });
  let userUrl  = "<?php echo e(route('becomeuser')); ?>" ;
  $("#captchaFormUser").submit(function(e){
    isVarified  = true ;
    let answerInput = $("#useranswer");
    if($(answerInput).val() == ""){
      e.preventDefault();
      isVarified = false ;
      swal({
        title: 'You Are missing Something!',
        text: "Captcha Verification is Required!",
        animation: false,            
        type: 'error',                 
      });
      return false ;
    }
    let number1 = parseInt($("#usernum1").text()) ;
    let number2 = parseInt($("#usernum2").text()) ;
    let answer  = number1 + number2 ;
    if(answer != parseInt(answerInput.val())){
      e.preventDefault();
      swal({
        title: 'Incorrect Captcha!',
        text: "Captcha Verification Failed Try Again!",
        animation: false,            
        type: 'error',                 
      });
      const num1 = Math.floor(Math.random() * 10);
      const num2 = Math.floor(Math.random() * 10);
      document.getElementById('usernum1').textContent = num1;
      document.getElementById('usernum2').textContent = num2;
    }
    if(answer == parseInt(answerInput.val())){
      e.preventDefault();
      swal({
        title: 'Captcha Verified!',
        text: "Captcha Verification SuccessFull! Sending Coverage Request",
        animation: false,            
        type: 'success',                 
      });
      $("#captchaPopupUser").fadeOut();
      $.ajax({
        url : userUrl , 
        type : 'Post' , 
        data : $("#becomeAUserFrm").serialize(),
        success:function(res){
          console.log(res);
          if(res.status == true){
            swal({
              title: 'Coverage Request Sent!',
              text: "Message For Coverage Request as a Consumer has been Sent!",
              type: 'success',                 
            },
            );
            $('#becomeAUserFrm')[0].reset();
            $("#captchaSubmitUser").text("Send");
          }
          else
          {
            swal({
              title: 'Error!',
              text: "Failed to send Contact request!",
              animation: false,            
              type: 'error',                 
            });
          }
        }
      })
    }
  });
  $("#refreshCaptcha").on('click' , function(e){
   e.preventDefault();
   const num1 = Math.floor(Math.random() * 10);
   const num2 = Math.floor(Math.random() * 10);
   document.getElementById('usernum1').textContent = num1;
   document.getElementById('usernum2').textContent = num2;
 });
  $(document).on('submit','#frontcontactform',function(e){
    e.preventDefault();
    $.ajax({
      url: "/site/frontcontactform",
      type: "POST",
      dataType: "json",
      data:  new FormData(document.forms.namedItem("frontcontactform")),
      contentType: false,
      cache: false,
      processData:false,
      beforeSend:function(){
        $('#p-btn').prop('disabled',true).html('<img src="<?php echo e(asset('site/css/images/spinner.gif')); ?>" width="30" alt="contact-preloader">');
      },
      success:function(res){
       if($.isEmptyObject(res.error)){
        if(res.status == true);
        {
          $('.modal').modal('hide');
          swal('Message','Your request submitted successfully','success' );
        }
      }
      else
      {
        printErrorMsg(res.error,'#pError');
        $('.modal').modal('hide');
        //    swal('Validation Failed', errMessage);
          //printErrorMsg(res.error,'#reassignError');
        }
      },
      error:function(jhxr,status,err)
      {
       console.log(jhxr);
       $('.modal').modal('hide');
     },
     complete:function()
     {
      $('#p-btn').prop('disabled',false).text('Send');
    }
  });
  });
</script>
<script src="<?php echo e(asset('site/js/jquery-migrate.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/responsive-lightbox/assets/nivo/nivo-lightbox.min.js')); ?>"></script>
<script>
  /* <![CDATA[ */
  var rlArgs = {
    script: "nivo",
    selector: "lightbox",
    customEvents: "",
    activeGalleries: "1",
    effect: "fade",
    clickOverlayToClose: "1",
    keyboardNav: "1",
    errorMessage: "The requested content cannot be loaded. Please try again later.",
  };
  /* ]]> */
</script>
<script src="<?php echo e(asset('site/js/plugins/responsive-lightbox/js/frontd.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/jquery.themepunch.tools.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/jquery.themepunch.revolution.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/extensions/revolution.extension.slideanims.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/extensions/revolution.extension.layeranimation.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/extensions/revolution.extension.kenburn.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/extensions/revolution.extension.navigation.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/extensions/revolution.extension.parallax.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/extensions/revolution.extension.actions.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/extensions/revolution.extension.video.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/revslider/public/assets/js/extensions/revolution.extension.layeranimation.min.js')); ?>"></script>
<script>
  (function ($) {
    $(document).ready(function () {
      $("body").addClass("transparent-header");
    });
  })(jQuery);
</script>
<script src="<?php echo e(asset('site/js/plugins/js-skin.js')); ?>"></script>
<script>
  function setREVStartSize(e) {
    try {
      var i = jQuery(window).width(),
      t = 9999,
      r = 0,
      n = 0,
      l = 0,
      f = 0,
      s = 0,
      h = 0;
      if (
        (e.responsiveLevels &&
          (jQuery.each(e.responsiveLevels, function (e, f) {
            f > i && ((t = r = f), (l = e)), i > f && f > r && ((r = f), (n = e));
          }),
          t > r && (l = n)),
          (f = e.gridheight[l] || e.gridheight[0] || e.gridheight),
          (s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth),
          (h = i / s),
          (h = h > 1 ? 1 : h),
          (f = Math.round(h * f)),
          "fullscreen" == e.sliderLayout)
        ) {
        var u = (e.c.width(), jQuery(window).height());
      if (void 0 != e.fullScreenOffsetContainer) {
        var c = e.fullScreenOffsetContainer.split(",");
        if (c)
          jQuery.each(c, function (e, i) {
            u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u;
          }),
        e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0
        ? (u -= (jQuery(window).height() * parseInt(e.fullScreenOffset, 0)) / 100)
        : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0));
      }
      f = u;
    } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
    e.c.closest(".rev_slider_wrapper").css({ height: f });
  } catch (d) {
    console.log("Failure at Presize of Slider:" + d);
  }
}
</script>
<script>
  function revslider_showDoubleJqueryError(sliderID) {
    var errorMessage = "Revolution Slider Error: You have some jquery.js')}} library include that comes after the revolution files js include.";
    errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
    errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
    errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js')}} include and remove it.";
    errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
    jQuery(sliderID).show().html(errorMessage);
  }
</script>
<script>
  (function ($) {
    $(document).ready(function () {
      $("#portfolio-list-79562184").mixItUp({ effects: ["rotateX", "scale"], easing: "snap" });
    });
  })(jQuery);
</script>
<script>
  /* <![CDATA[ */
  var thickboxL10n = {
    next: "Next >",
    prev: "< Prev",
    image: "Image",
    of: "of",
    close: "Close",
    noiframes: "This feature requires inline frames. You have iframes disabled or your browser does not support them.",
    loadingAnimation: "http:\/\/wp.magnium-themes.com\/barrel\/barrel-1\/wp-includes\/js\/thickbox\/loadingAnimation.gif",
  };
  /* ]]> */
</script>
<script src="<?php echo e(asset('site/js/plugins/thickbox/thickbox.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/easing.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/owl-carousel/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/jquery.nanoscroller.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/jquery.mixitup.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/TweenMax.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/template.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/js_composer/assets/js/dist/js_composer_front.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/js_composer/assets/lib/waypoints/waypoints.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/jquery.appear.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/jquery.countTo.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/js_composer/assets/lib/bower/skrollr/dist/skrollr.min.js')); ?>"></script>

<script src="<?php echo e(asset('site/js/plugins/js_composer/assets/lib/vc_tabs/vc-tabs.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/plugins/slick.min.js')); ?>"></script>

<script src="<?php echo e(asset('site/js/modernizr.js')); ?>"></script>
<script src="<?php echo e(asset('site/js/jquery.zoomslider.js')); ?>"></script>
<script>
  var htmlDiv = document.getElementById("rs-plugin-settings-inline-css");
  var htmlDivCss = "";
  if (htmlDiv) {
    htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
  } else {
    var htmlDiv = document.createElement("div");
    htmlDiv.innerHTML = "<style>" + htmlDivCss + "</style>";
    document.getElementsByTagName("head")[0].appendChild(htmlDiv.childNodes[0]);
  }
</script>
<script>
  if (setREVStartSize !== undefined)
    setREVStartSize({
      c: "#rev_slider_1_1",
      responsiveLevels: [1240, 1240, 1240, 480],
      gridwidth: [1240, 1240, 1240, 480],
      gridheight: [650, 650, 650, 720],
      sliderLayout: "fullscreen",
      fullScreenAutoWidth: "off",
      fullScreenAlignForce: "off",
      fullScreenOffsetContainer: "",
      fullScreenOffset: "",
    });
  var revapi1, tpj;
  (function () {
    if (!/loaded|interactive|complete/.test(document.readyState)) document.addEventListener("DOMContentLoaded", onLoad);
    else onLoad();
    function onLoad() {
      if (tpj === undefined) {
        tpj = jQuery;
        if ("off" == "on") tpj.noConflict();
      }
      if (tpj("#rev_slider_1_1").revolution == undefined) {
        revslider_showDoubleJqueryError("#rev_slider_1_1");
      } else {
        revapi1 = tpj("#rev_slider_1_1")
        .show()
        .revolution({
          sliderType: "standard",
          jsFileLocation: "//wp.magnium-themes.com/barrel/barrel-10/wp-content/plugins/revslider/public/assets/js/",
          sliderLayout: "fullscreen",
          dottedOverlay: "none",
          delay: 9000,
          navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            mouseScrollReverse: "default",
            onHoverStop: "off",
            touch: {
              touchenabled: "on",
              touchOnDesktop: "off",
              swipe_threshold: 75,
              swipe_min_touches: 1,
              swipe_direction: "horizontal",
              drag_block_vertical: false,
            },
          },
          responsiveLevels: [1240, 1240, 1240, 480],
          visibilityLevels: [1240, 1240, 1240, 480],
          gridwidth: [1240, 1240, 1240, 480],
          gridheight: [650, 650, 650, 720],
          lazyType: "none",
          parallax: {
            type: "mouse",
            origo: "enterpoint",
            speed: 400,
            speedbg: 0,
            speedls: 0,
            levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
            disable_onmobile: "on",
          },
          shadow: 0,
          spinner: "spinner0",
          stopLoop: "off",
          stopAfterLoops: -1,
          stopAtSlide: -1,
          shuffle: "off",
          autoHeight: "off",
          fullScreenAutoWidth: "off",
          fullScreenAlignForce: "off",
          fullScreenOffsetContainer: "",
          fullScreenOffset: "",
          hideThumbsOnMobile: "off",
          hideSliderAtLimit: 0,
          hideCaptionAtLimit: 0,
          hideAllCaptionAtLilmit: 0,
          debugMode: false,
          fallbacks: {
            simplifyAll: "off",
            nextSlideOnWindowFocus: "off",
            disableFocusListener: false,
          },
        });
      } /* END OF revapi call */
    } /* END OF ON LOAD FUNCTION */
  })(); /* END OF WRAPPING FUNCTION */
</script>
<script>
  (function ($) {
    $(document).ready(function () {
      $('.package-slider').slick({
      });
      $('.contractor-slider').slick({
        slidesToShow: 3,
        infinite: true,
        dots: true,
        responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 1,
          }
        }
        ]
      });
      $(".mgt-images-slider.mgt-images-slider-70568182 .mgt-images-slider-items").on("init", function (slick) {
        $(".mgt-images-slider.mgt-images-slider-70568182 .mgt-images-slider-items").show();
      });
      $(".mgt-images-slider.mgt-images-slider-70568182 .mgt-images-slider-items").slick({
        pauseOnHover: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 4000,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        speed: 500,
        centerMode: false,
        centerPadding: "60px",
        variableWidth: false,
        adaptiveHeight: false,
        fade: false,
        cssEase: "ease",
        vertical: false,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        ],
      });
    });
  })(jQuery);
</script>
<script>
  (function ($) {
    $(document).ready(function () {
      $("#portfolio-list-89684162").mixItUp({ effects: ["fade", "scale"], easing: "snap" });
    });
  })(jQuery);
</script>
<script>
  (function ($) {
    $(document).ready(function () {
      $(".mgt-images-slider.mgt-images-slider-5735027 .mgt-images-slider-items").on("init", function (slick) {
        $(".mgt-images-slider.mgt-images-slider-5735027 .mgt-images-slider-items").show();
      });
      $(".mgt-images-slider.mgt-images-slider-5735027 .mgt-images-slider-items").slick({
        pauseOnHover: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        speed: 300,
        centerMode: false,
        centerPadding: "60px",
        variableWidth: false,
        adaptiveHeight: true,
        fade: false,
        cssEase: "ease",
        vertical: false,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        ],
      });
    });
  })(jQuery);
</script>
<script>
  (function ($) {
    $(document).ready(function () {
      $("#mgt-post-list-46894146").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [770, 1],
        itemsMobile: [480, 1],
        autoPlay: false,
        navigation: false,
        navigationText: false,
        pagination: false,
        afterInit: function (elem) {
          $(this).css("display", "block");
        },
      });
    });
  })(jQuery);
</script>
<script>
  (function ($) {
    $(document).ready(function () {
      $(".mgt-images-slider.mgt-images-slider-33473820 .mgt-images-slider-items").on("init", function (slick) {
        $(".mgt-images-slider.mgt-images-slider-33473820 .mgt-images-slider-items").show();
      });
      $(".mgt-images-slider.mgt-images-slider-33473820 .mgt-images-slider-items").slick({
        pauseOnHover: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: true,
        dots: true,
        speed: 800,
        centerMode: false,
        centerPadding: "0",
        variableWidth: false,
        adaptiveHeight: false,
        fade: false,
        cssEase: "ease",
        vertical: false,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        ],
      });
    });
  })(jQuery);
</script>
<script>
  function showServiceModal(title, description) {
    $('#modalDescription').html(description);
    $('#serviceModalTitle').text(title);
    $('#serviceModal').modal('show');
  }
</script>
<?php echo \Livewire\Livewire::scripts(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/site/partial/scripts.blade.php ENDPATH**/ ?>