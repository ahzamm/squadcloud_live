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
 $menusAccess = App\Models\UserMenuAccess::where('user_id',Auth::id())->where('view_status',1)
 ->join('sub_menus', 'user_menu_accesses.sub_menu_id', '=', 'sub_menus.id')
 ->join('menus', 'sub_menus.menu_id', '=', 'menus.id')
 ->distinct('menus.id')
 ->select(['menus.id','menus.menu','menus.has_submenu','menus.icon','menus.order_menu'])->orderBy('menus.order_menu')->get();
 // dd($menusAccess);
 @endphp
 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link" style="display: block">
    {{-- <img src="{{asset('site/images/title-white.png')}}" style="float: none;max-height: 65px;" alt="AdminLTE Logo" class="brand-image "
    style="opacity: .8"> --}}
    <span class="brand-text font-weight-light" style="color: yellow; font-weight: light;"><a href="/admin"> SquadCloud</a> </span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php
        $general_configuration = \DB::table("general_configurations")->limit(1)->first();
        ?>
        <img src="{{asset('frontend_assets/images/' . $general_configuration->brand_logo)}}" class="img-circle elevation-2" style="object-fit: contain;" alt="User Image">
      </div>
      <div class="info">
        @if(Auth::check())
        <a class="d-block">{{Auth::user()->name}} ({{Auth::user()->role}})</a>
        @endif
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('home')}}" target="_blank" class="nav-link">
            <i @if(Request::route()->getName() == 'home') class="nav-icon fa fa-globe text-success" @else class="nav-icon fa fa-globe" @endif ></i>
            <p @if(Request::route()->getName() == 'home') class="text-success" @endif>
              Preview Website
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.dashboard')}}" class="nav-link">
            <i @if(Request::route()->getName() == 'admin.dashboard') class="nav-icon text-primary fas fa-chart-pie" @else class="nav-icon fas fa-chart-pie" @endif></i>
            <p @if(Request::route()->getName() == 'admin.dashboard') class="text-primary" @endif>
              Dashboard
            </p>
          </a>
        </li>
        @foreach($menusAccess as $key => $values)
        @php
        $Submenus = App\Models\UserMenuAccess::where('user_id',Auth::id())->where('view_status',1)->where('sub_menus.menu_id',$values->id)
        ->join('sub_menus', 'user_menu_accesses.sub_menu_id', '=', 'sub_menus.id')->get();
        @endphp
        @if($values->has_submenu == 0)
        <li class="nav-item">
          <a href="{{route($Submenus->first()->route_name)}}" class="nav-link">
            <i @if(Request::route()->getName() == $Submenus->first()->route_name) class="nav-icon text-primary {{$values->icon == ''?'fa fa-bars':$values->icon}}" @else class="nav-icon {{$values->icon == ''?'fa fa-bars':$values->icon}}" @endif></i>
            <p @if(Request::route()->getName() == $Submenus->first()->route_name) class="text-primary" @endif>
              {{$Submenus->first()->submenu}}
            </p>
          </a>
        </li>
        @else
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon {{$values->icon == ''?'fa fa-bars':$values->icon}}"></i>
            <p>
              {{$values->menu}}
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @foreach($Submenus as $submenu)
            <li class="nav-item">
              <a href="{{route($submenu->route_name)}}" class="nav-link">
                {{-- <a href="" class="nav-link"> --}}
                  <i class="far fa-circle nav-icon"></i>
                  <p class="paragraph">{{$submenu->submenu}}</p>
                </a>
                <script>
                  @if(Request::route() -> getName() == $submenu -> route_name)
                  let parentUlElement = document.querySelector("a[href='{{route($submenu->route_name)}}']").closest(".nav-treeview");
                  let parentLi = document.querySelector("a[href='{{route($submenu->route_name)}}']").closest(".has-treeview");
                  let iconElement = document.querySelector("a[href='{{route($submenu->route_name)}}'] i.nav-icon");
                  let pElement = document.querySelector("a[href='{{route($submenu->route_name)}}'] p.paragraph");
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
                  @endif
                </script>
              </li>
              @endforeach
            </ul>
          </li>
          @endif
          @endforeach
          <!-- START ADMIN MENU -->
          @if (Auth::user()->role == "admin")
          <li class="nav-item">
            <a href="{{ route('menus.index') }}" class="nav-link @if(Request::route()->getName() == "menus.create") active @endif">
              <i class="nav-icon fas fa-user-shield @if(Request::route()->getName() == "menus.create") text-primary @endif"></i>
              <p class="@if(Request::route()->getName() == "menus.index") text-primary @endif">Admin Menus</p>
            </a>
          </li>
          @endif
          <!-- END ADMIN MENU -->
          <!-- END OLD ADMIN MENU -->
          <li class="nav-item mx-2 mt-auto">
            <a class="nav-link" style="cursor:pointer;" onclick="event.preventDefault();document.getElementById('logout-form').submit();" role="button">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              <p>Logout</p>
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<!-- Code Finalize -->
