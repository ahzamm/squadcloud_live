<!-- jQuery -->
<script src="<?php echo e(asset('backend/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('backend/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('backend/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('backend/plugins/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo e(asset('backend/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('backend/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('backend/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('backend/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('backend/dist/js/adminlte.js')); ?>"></script>
<!-- Draggable Js Scripts -->
<script src="<?php echo e(asset('draggable-js/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('draggable-js/jquery-ui.js')); ?>"></script>
<script src="<?php echo e(asset('draggable-js/dataSorting.js')); ?>"></script>
<!-- Font Awesome -->
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/brands.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/all.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/regular.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/solid.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/plugins/fontawesome-free/js/fontawesome.min.js')); ?>"></script>
<script src="<?php echo e(asset('site/sweet-alert/sweetalert2.min.js')); ?>"></script>
<!-- Editor -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<?php if(Session::has("success")): ?>
<script>
  swal({
    title: 'Success!',
    text: "<?php echo e(Session::get('success')); ?>",
    animation: false,
    customClass: 'animated pulse',
    type: 'success',
  });
</script>
<?php endif; ?>
<?php if(Session::has("error")): ?>
<script>
  swal({
    title: 'Error!',
    text: '<?php echo e(Session::get("error")); ?>',
    animation: false,
    customClass: 'animated pulse',
    type: 'error',
  });
</script>
<?php endif; ?>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  function printErrorMsg(msg,container) {
    $(container).html('<ul style="list-style:none" class="pl-0"></ul>');
    $(container).css('display','block');
    $.each( msg, function( key, value ) {
     $(container).find("ul").append('<li>'+value+'</li>');
   });
  }
</script><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/partial/scripts.blade.php ENDPATH**/ ?>