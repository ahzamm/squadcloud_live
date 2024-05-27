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
 <div class="header-left">
 	@if(empty($f_logo))
 	<a class="logo-link logo-text" href="{{route('home')}}"><img src="" alt="Blink Broadband" style="color: #fff;"/></a>
 	@else
 	<a class="logo-link logo-text" href="{{route('home')}}"><img src="{{url('front-logo/'.$f_logo->image)}}" alt="best internet packages in Pakistan"/></a>
 	@endif
 	<div class="mobile-sidebar-trigger">
 		<div class="st-sidebar-trigger-effects">
 			<a class="float-sidebar-toggle-btn" data-effect="st-sidebar-effect-2"><i class="fa fa-bars"></i></a>
 		</div>
 	</div>
 	<div class="mobile-main-menu-toggle" data-toggle="collapse" data-target=".collapse"><i class="fa fa-bars"></i></div>
 </div>
<!-- Code Finalize -->