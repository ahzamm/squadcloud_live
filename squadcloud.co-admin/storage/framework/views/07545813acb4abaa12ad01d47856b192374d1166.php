<?php
$menusAccess = App\Models\UserMenuAccess::where('user_id',Auth::id())->where('view_status',1)
->join('sub_menus', 'user_menu_accesses.sub_menu_id', '=', 'sub_menus.id')
->join('menus', 'sub_menus.menu_id', '=', 'menus.id')
->distinct('menus.id')
->select(['menus.id','menus.menu','menus.has_submenu','menus.icon','menus.order_menu'])->orderBy('menus.order_menu')->get();
// dd($menusAccess);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link" style="display: block">
    
    <span class="brand-text font-weight-light">Blink Broadband</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php
        $mainLogo = \DB::table("logos")->limit(1)->first();
        ?>
        <img src="<?php echo e(asset('front-logo/' . $mainLogo->image)); ?>" class="img-circle elevation-2" style="object-fit: contain;" alt="User Image">
      </div>
      <div class="info">
        <a class="d-block"><?php echo e(Auth::user()->name); ?> (<?php echo e(Auth::user()->role); ?>)</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?php echo e(route('home')); ?>" target="_blank" class="nav-link">
            <i <?php if(Request::route()->getName() == 'home'): ?> class="nav-icon fa fa-globe text-success" <?php else: ?> class="nav-icon fa fa-globe" <?php endif; ?> ></i>
            <p <?php if(Request::route()->getName() == 'home'): ?> class="text-success" <?php endif; ?>>
              Preview Website
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">
            <i <?php if(Request::route()->getName() == 'admin.dashboard'): ?> class="nav-icon text-success fas fa-chart-pie" <?php else: ?> class="nav-icon fas fa-chart-pie" <?php endif; ?>></i>
            <p <?php if(Request::route()->getName() == 'admin.dashboard'): ?> class="text-success" <?php endif; ?>>
              Dashboard
            </p>
          </a>
        </li>
        <?php $__currentLoopData = $menusAccess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $Submenus = App\Models\UserMenuAccess::where('user_id',Auth::id())->where('view_status',1)->where('sub_menus.menu_id',$values->id)
        ->join('sub_menus', 'user_menu_accesses.sub_menu_id', '=', 'sub_menus.id')->get();
        ?>
        <?php if($values->has_submenu == 0): ?>
        <li class="nav-item">
          <a href="<?php echo e(route($Submenus->first()->route_name)); ?>" class="nav-link">
            <i <?php if(Request::route()->getName() == $Submenus->first()->route_name): ?> class="nav-icon text-success <?php echo e($values->icon == ''?'fa fa-bars':$values->icon); ?>" <?php else: ?> class="nav-icon <?php echo e($values->icon == ''?'fa fa-bars':$values->icon); ?>" <?php endif; ?>></i>
            <p <?php if(Request::route()->getName() == $Submenus->first()->route_name): ?> class="text-success" <?php endif; ?>>
              <?php echo e($Submenus->first()->submenu); ?>

            </p>
          </a>
        </li>
        <?php else: ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon <?php echo e($values->icon == ''?'fa fa-bars':$values->icon); ?>"></i>
            <p>
              <?php echo e($values->menu); ?>

              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php $__currentLoopData = $Submenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
              <a href="<?php echo e(route($submenu->route_name)); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p class="paragraph"><?php echo e($submenu->submenu); ?></p>
              </a>
              <script>
                <?php if(Request::route() -> getName() == $submenu -> route_name): ?>
                let parentUlElement = document.querySelector("a[href='<?php echo e(route($submenu->route_name)); ?>']").closest(".nav-treeview");
                let parentLi = document.querySelector("a[href='<?php echo e(route($submenu->route_name)); ?>']").closest(".has-treeview");
                let iconElement = document.querySelector("a[href='<?php echo e(route($submenu->route_name)); ?>'] i.nav-icon");
                let pElement = document.querySelector("a[href='<?php echo e(route($submenu->route_name)); ?>'] p.paragraph");
                let parentLiIcon = parentLi.querySelector("i.nav-icon");
                let parentIconP = parentLi.querySelector("p");
                parentUlElement.style.display = "block";
                parentLi.classList.add("menu-open", 'text-success');
                pElement.classList.add("text-success")
                parentLiIcon.classList.add("text-success")
                parentIconP.classList.add("text-success")
                if (iconElement) {
                  iconElement.classList.remove("far", "fa-circle", "text-muted");
                  iconElement.classList.add("fas", "fa-circle", "nav-icon", "text-success");
                }
                <?php endif; ?>
              </script>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- START ADMIN MENU -->
        <?php if(Auth::user()->role == "admin"): ?>
        <li class="nav-item">
          <a href="<?php echo e(route('menus.index')); ?>" class="nav-link <?php if(Request::route()->getName() == "menus.create"): ?> active <?php endif; ?>">
            <i class="nav-icon fas fa-user-shield <?php if(Request::route()->getName() == "menus.create"): ?> text-success <?php endif; ?>"></i>
            <p class="<?php if(Request::route()->getName() == "menus.index"): ?> text-success <?php endif; ?>">Admin Menus</p>
          </a>
        </li>
        <?php endif; ?>
        <!-- END ADMIN MENU -->
        <!-- END OLD ADMIN MENU -->  
<!--
  <?php if(Auth::user()->role == "admin"): ?>
        <li <?php if(Request::route()->getName() == "menus.create" ||Request::route()->getName() == "menus.index" ): ?> class="nav-item has-treeview menu-open" <?php else: ?> class="nav-item has-treeview" <?php endif; ?>>
          <a href="#" class="nav-link">
            <i <?php if(Request::route()->getName() == "menus.create" ||Request::route()->getName() == "menus.index" ): ?> class="nav-icon fas fa-user-shield text-success" <?php else: ?> class="nav-icon fas fa-user-shield" <?php endif; ?> class="nav-icon fas fa-copy"></i>
            <p <?php if(Request::route()->getName() == "menus.create" ||Request::route()->getName() == "menus.index" ): ?> class="text-success" <?php endif; ?>>
              Admin Menus
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo e(route('menus.create')); ?>" class="nav-link">
                <i <?php if(Request::route()->getName() == "menus.create" ): ?> class="nav-icon fas fa-circle text-success" <?php else: ?> class="nav-icon far fa-circle" <?php endif; ?> class="nav-icon far fa-circle"></i>
                <p <?php if(Request::route()->getName() == "menus.create"): ?> class="text-success" <?php endif; ?>>Add Menu</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(route('menus.index')); ?>" class="nav-link">
                <i <?php if(Request::route()->getName() == "menus.index" ): ?> class="nav-icon fas fa-circle text-success" <?php else: ?> class="nav-icon far fa-circle" <?php endif; ?> class="nav-icon far fa-circle"></i>
                <p <?php if(Request::route()->getName() == "menus.index"): ?> class="text-success" <?php endif; ?>>View Menus</p>
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>
      -->
      <!-- END OLD ADMIN MENU -->
      <li class="nav-item mx-2 mt-auto">
        <a class="nav-link" style="cursor:pointer;" onclick="event.preventDefault();document.getElementById('logout-form').submit();" role="button">
          <i class="fa fa-sign-out" aria-hidden="true"></i>
          <p>Logout</p>
        </a>
        <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
          <?php echo csrf_field(); ?>
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside><?php /**PATH /www/wwwroot/blinkbroadband.pk/resources/views/admin/partial/aside.blade.php ENDPATH**/ ?>