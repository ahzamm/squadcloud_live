<style>
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
  button {
    padding: 12px 20px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s;
  }
  button:hover {
    background-color: #45a049;
  }
  .fa-refresh {
    color: #22a638;
  }
  /* Add your existing CSS styles here */
  /* Popup styles */
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
  .overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.1); /* Adjust the alpha value here */
    z-index: 9998;
  }
</style>
<div role="form" class="wpcf7" id="wpcf7-f2869-p19-o1" lang="en-US" dir="ltr">
  <?php if(session()->has('message')): ?>
  <div class="screen-reader-response"><?php echo e(session()->get('message')); ?></div>
  <?php endif; ?>
  
    <form  method="post" id="contactForm">
     <?php echo csrf_field(); ?> 
     <div class="quform-elements">
      <div class="quform-element">
        <p>
          <span class="wpcf7-form-control-wrap your-name">
            <input id="fisrtname" type="text" wire:model="name" name="name" size="40" class="input1" aria-required="true" aria-invalid="false" placeholder="First & Last Name">
          </span> 
          <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>
      </div>
      <div class="quform-element">
        <p>
          <span class="wpcf7-form-control-wrap your-email">
            <input id="c_email" type="text" wire:model="email" name="email" size="40" class="input1" aria-required="true" aria-invalid="false" placeholder="Email Address">
          </span> 
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>
      </div>
      <div class="quform-element">
        <p>
          <span class="wpcf7-form-control-wrap your-phone">
            <input id="c_phone" type="text" wire:model="phone" name="phone" size="40" class="input1" aria-required="true" aria-invalid="false" placeholder="Phone Number">
          </span> 
          <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </p>
      </div>
      <div class="quform-element">
        <span class="wpcf7-form-control-wrap your-message">
          <textarea  id="c_message" wire:model="message" name="message" cols="40" rows="10" class="input1" aria-invalid="false" placeholder="Message"></textarea>
        </span>
        <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
      <div class="quform-submit">
        <div class="quform-submit-inner">
          <button type="submit" class="submit-button" id="sendFormButton">Send</button>
        </div>
      </div>
    </div>
  </form>
  <div class="popup" id="captchaPopup">
    <button class="mb-3" style="color: black!important; background:transparent!important;float:right;" onclick="closecaptcha()">X</button>
    <div class="clearfix"></div>
    <div class="captcha-box">
      <div class="captcha">
        <p>Please solve the addition:</p>
        <div class="numbers">
          <span id="captchaAnswer">0</span>
          <span>+</span>
          <span id="captchaAnswer2">5</span>
          <span><i class="fa fa-refresh" aria-hidden="true" onclick="refreshCaptcha()"></i></span>
        </div>
        <form id="captchaForm">
          <input type="text" id="resultAnswer" placeholder="Your answer">
          <button type="submit" id="captchaSubmit">Submit</button>
          <p id="result"></p>
        </div>
      </div>
    </form>  
  </div>
</div>
<script>
</script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('sweet-alert/sweetalert2.min.js')); ?>"></script>
<script>
  function closecaptcha(){
    document.getElementById('captchaPopup').style.display = 'none';
    document.querySelector('.overlay').style.display = 'none';
    $("#resultAnswer").val("");
  }
// Function to refresh the CAPTCHA numbers
function refreshCaptcha() {
  const num1 = Math.floor(Math.random() * 10);
  const num2 = Math.floor(Math.random() * 10);
  document.getElementById('captchaAnswer').textContent = num1;
  document.getElementById('captchaAnswer2').textContent = num2;
}
let contactFormLink =  "<?php echo e(route('user.contact')); ?>";
$("#contactForm").submit(function(e){
  const num1 = Math.floor(Math.random() * 10);
  const num2 = Math.floor(Math.random() * 10);
  document.getElementById('captchaAnswer').textContent = num1;
  document.getElementById('captchaAnswer2').textContent = num2;
  let  isValid = true ;
  if($('#fisrtname').val() == ""){
    e.preventDefault();
    swal({
      title: 'You Are missing Something!',
      text: "First and Last Name is Required!",
      animation: false,            
      type: 'error',                 
    });
    isValid = false;
    return false;
  }
  if($('#c_email').val() == ""){
    e.preventDefault();
    swal({
      title: 'You Are missing Something!',
      text: "Email Address is Required!",
      animation: false,            
      type: 'error',                 
    });
    isValid = false;
    return false;
  }
  if($('#c_message').val() == ""){
    e.preventDefault();
    swal({
      title: 'You Are missing Something!',
      text: "Message is Required!",
      animation: false,            
      type: 'error',                 
    });
    isValid = false;
  }
  if($('#c_phone').val() == ""){
    e.preventDefault();
    swal({
      title: 'You Are missing Something!',
      text: "Phone Number is Required!",
      animation: false,            
      type: 'error',                 
    });
    isValid = false;
  }

  if(isValid == true){
          // Check the Captcha then will send ajax request to Store contact infor
          e.preventDefault();
          const num1 = Math.floor(Math.random() * 10);
          const num2 = Math.floor(Math.random() * 10);
          document.getElementById('captchaAnswer').textContent = num1;
          document.getElementById('captchaAnswer2').textContent = num2;
          $("#captchaPopup").fadeIn();
        }
      });
$("#captchaForm").submit(function(e){
  isVarified  = true ;
  let answerInput = $("#resultAnswer");
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
  let number1 = parseInt($("#captchaAnswer").text()) ;
  let number2 = parseInt($("#captchaAnswer2").text()) ;
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
    document.getElementById('captchaAnswer').textContent = num1;
    document.getElementById('captchaAnswer2').textContent = num2;
  }
  if(answer == parseInt(answerInput.val())){
    e.preventDefault();
    swal({
      title: 'Captcha Verified!',
      text: "Captcha Verification SuccessFull!",
      animation: false,            
      type: 'success',                 
    });
    $("#captchaPopup").fadeOut();
    $("#sendFormButton").text("Sending Request....");
    $.ajax({
      url : contactFormLink , 
      type : 'Post' , 
      data : $("#contactForm").serialize(),
      success:function(res){
        console.log(res);
        if(res.status == true){
          swal({
            title: 'Contact Message Sent!',
            text: "Message For Contact Request has been Sent!",
            type: 'success',                 
          },
          );
          $('#contactForm')[0].reset();
          $("#resultAnswer").val("");
          $("#sendFormButton").text("Send");
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
</script><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/livewire/front/contact.blade.php ENDPATH**/ ?>