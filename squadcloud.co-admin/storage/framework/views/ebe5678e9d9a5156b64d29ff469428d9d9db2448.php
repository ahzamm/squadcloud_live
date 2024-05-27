
<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','Add Menu'); ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card mt-2">
            <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0"><span><i class="fa-solid fa-user-shield"></i></span> Create Admin Menu</h3>
            <div class="ml-auto">
              <a class="btn btn-outline-secondary btn-sm" href="<?php echo e(route('menus.index')); ?>">
                <i class="fa fa-arrow-left"></i> Back
              </a>
            </div>
          </div>
                
                 
              <div class="row mt-5 justify-content-center">
                <div class="col-md-8 col-sm-12 col-xs-12">
                  <div class="card" style="border-color: rgb(126, 120, 120);">
                
                    <div class="card-body">              
                    <form action="<?php echo e(route('menus.store')); ?>" method="POST" id="AddMenusForm">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                              <div class="i-checks float-right">
                                  <input id="hassubmenu" type="checkbox" value="hassubmenu" name="hassubmenu" data-value="false" checked="" class="checkbox-template">
                                  <label for="hassubmenu">Has SubMenus <span style="color: red">*</span></label>
                                </div>
                            </div>
                          <div class="col-lg-12 col-sm-12 col-xs-12">
                              <div class="form-group">
                                  <label>Main Menu Name <span style="color: red">*</span></label>
                                  <input name="parentMenu" type="text" class="form-control" placeholder="Example : About Us" required>
                              </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Select Icon <span style="color: red">*</span></label>
                              <select name="menuicon" class="form-control" id="selectIcon">
                                <option value></option>
                                <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($item); ?>"><?php echo e($item); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                  <p class="text-danger mt-2 mb-0 text-sm"><?php echo e($message); ?></p>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                          <div class="col-md-12" id="singleRoute" style="display: none">
                              
                          </div>
                          <div class="col-md-12" id="subRoute">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>SubMenu Name <span style="color: red">*</span></th>
                                          <th>SubMenu Route <span style="color: red">*</span></th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody id="submenu-list">
                                      <tr>
                                          <td class="td-first">
                                              <input type="" name="submenu[]" placeholder="Example : View Detail" class="form-control" required/>
                                          </td>
                                          <td class="td-second">
                                              <input type="" name="submenuroute[]" placeholder="Example : viewdetail.index" class="form-control" required/>
                                              <span class="text-danger text-sm d-none">Route name not exist in database</span>
                                          </td>
                                          <td><button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button></td>
                                      </tr>
                                  </tbody>
                                 
                                  
                              </table>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <a class="btn btn-outline-secondary btn-sm float-right ml-2" href="<?php echo e(route('menus.index')); ?>">Cancel</a>
                                  <button class="btn btn-outline-primary btn-sm float-right" type="submit" id="menuBtn">Submit</button>
                              
                                </div>
                          </div>
                      
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
    </section>
</div>
    
<script type="text/html" id="data-row">
<tr>
                            <td class="td-first">
                                <input type="" name="submenu[]" placeholder="Sub Menu Name" class="form-control" required/>
                            </td>
                            <td class="td-second">
                                <input type="" name="submenuroute[]" placeholder="Sub Menu Route" class="form-control" required/>
                                <span class="text-danger text-sm d-none">Route name not exist in database</span>
                            </td>
                            <td><button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button></td>
                        </tr>

</script>
<script type="text/html" id="singleMenubody">
    <div class="form-group">
        <label>Route Name</label>
        <input name="parentroutename" type="text" class="form-control" required>
      </div>
</script>
<script type="text/html" id="subMenubody">
    <table class="table">
        <thead>
            <tr>
                <th>Sub Menu Name</th>
                <th>Sub Menu Route</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="submenu-list">
            <tr>
                <td class="td-first">
                    <input type="" name="submenu[]" placeholder="Sub Menu Name" class="form-control" required/>
                </td>
                <td class="td-second">
                    <input type="" name="submenuroute[]" placeholder="Sub Menu Route" class="form-control" required/>
                    <span class="text-danger text-sm d-none">Route name not exist in database</span>
                </td>
                <td><button class="btn btn-success btn-sm my-1" type="button" id="btnAddSubMenu"><i class="fa fa-plus"></i></button></td>
            </tr>
        </tbody>
       
        
    </table>
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('backend/plugins/select2/js/select2.full.min.js')); ?>"></script>
<script>
function formatState(state) {
          if (!state.id) {
            return state.text;
          }
        var $state = $(
          "<i class='"+state.element.value+"''></i> <span style='color:black;margin-left:10px'>"+state.element.value+"</span>"
            );
            return $state;
        }
    $(function(){
        $('.selectList').select2({
            theme: 'bootstrap4'
        })
        $('#selectIcon').select2({
          theme: 'bootstrap4',
          templateResult: formatState,
          templateSelection: formatState
        });
        $('.select2.select2-container').css('width','auto');
    })
function checkinput(input)
{
    if(input.val() == "")
    {
        $(input).css('border','1px solid red');
        return false;
    }
    else
    {
        $(input).css('border','1px solid #444951');
        return true;
    }
}

$(document).on('click','#btnAddSubMenu',function(){
    fristInput = $(this).parents('tr').find('td.td-first > input');
    secondInput = $(this).parents('tr').find('td.td-second > input');
    button = $(this);
    if(checkinput(fristInput) && checkinput(secondInput))
    {
        
            $.ajax({
                url:'<?php echo e(route("menus.checkroute")); ?>',
                method:'post',
                data:{
                    routename: secondInput.val()
                },
                dataType:'json',
                success:function(res){
                    if(res.status)
                    {
                        $(secondInput).siblings('span').addClass('d-none');
                        fristInput.prop('readonly',true);
                        secondInput.prop('readonly',true);
                        let dataRow = $('#data-row').html();
                        $('#submenu-list').append(dataRow);
                        $(button).removeClass("btn-success").addClass("btn-danger").html("<i class='fa fa-trash'></i>").attr('id','btnDeleteSubMenu');
                    }
                    else
                    {
                        $(secondInput).siblings('span').removeClass('d-none');
                    }
                    
                },
                error:function(jhxr,status,err){
                    //console.log(jhxr);
                }
            }) 
    }
    
})
$(document).on('click','#btnDeleteSubMenu',function(){
    $(this).parents('tr').remove();
})
$(document).on('submit','#AddMenusForm',function(e){
    // e.preventDefault();
    // $('#AddMenusForm input').each(function(index,val){
    //     //alert($(val).val());
    // })
    // $(this).submit;
})
$(document).on('change','#hassubmenu',function(){
    datavalue = $(this).attr('data-value');
    if(datavalue == "true")
    {
        $('#singleRoute').css('display','none').html("");
        $('#subRoute').css('display','block').html($('#subMenubody').html());
        $(this).attr('data-value',false);
    }
    else{
        $('#singleRoute').css('display','block').html($('#singleMenubody').html());;
        $('#subRoute').css('display','none').html("");
        $(this).attr('data-value',true);
    }
})
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/backmenu/create.blade.php ENDPATH**/ ?>