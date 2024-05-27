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
 {{-- @foreach ($frontmenus as $key => $item)
 	<li class="menu-ite onepage-link-inside">
 		@if(strtolower($item->menu_id) == "get services")
 		<a class="onepage-link" href="javascript:void(0)" onclick="showModal()" id="get__modal"><span>{{$item->menu}}</span></a>
 		@elseif(strtolower($item->menu_id) == "about-us")
 		<a class="onepage-link" href="#{{strtolower($item->menu_id)}}"><span>{{$item->menu}}</span></a>
 		<a class="logo-link logo-text" href="{{route('home')}}"><img src="{{url('front-logo/30-Oct-2023-Pch2jaTIMKB6.png')}}" alt="best internet packages in Pakistan"/>Blink</a>
 		@else
 		<a class="onepage-link" href="#{{strtolower($item->menu_id)}}"><span>{{$item->menu_id}}</span></a>
 		@endif
 	</li>
 	@endforeach  --}}
 	<li class="menu-ite onepage-link-inside">
 		<a class="onepage-link" href="#home"><span>Home</span></a> 
 		<a class="onepage-link" href="#bundle-offers"><span>Bundle Offer</span></a> 
 		<a class="onepage-link" href="#team"><span>Resellers</span></a> 
 		<a class="onepage-link" href="#about-us"><span>About Us</span></a> 
 		<a class="logo-link logo-text" href="{{route('home')}}"><img src="{{url('front-logo/30-Oct-2023-Pch2jaTIMKB6.png')}}" alt="best internet packages in Pakistan"/></a> 
 		<a class="onepage-link" href="#why-choose-us"><span>Why Us</span></a> 
 		<a class="onepage-link" href="javascript:void(0)" onclick="showModal()" id="get__modal"><span>Get Services</span></a> 
 		<a class="onepage-link" href="#contact"><span>Contact Us</span></a> 
 		<a class="onepage-link" href="#faqs"><span>FAQs</span></a> 
 	</li>
	<!-- Code Finalize -->