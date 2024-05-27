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
 <li class="menu-item onepage-link-inside">
 	@php
 	$menuCount = 0; 
 	@endphp
 	@foreach ($data['menues'] as $menu)
 	@if ($menuCount < 4) <a class="onepage-link" href="#{{ $menu->menu_id }}"><span>{{ $menu->menu }}</span></a>
 	@php
 	$menuCount++;
 	@endphp
 	@endif
 	@endforeach
 	@if(isset($data['logo']))
 	<a class="logo-link logo-text" href="{{ route('home') }}">
 		<img src="{{asset('front-logo/'.$data['logo']->image)}}" alt="{{$data['logo']->title}}">
 	</a>
 	@endif
 	@php $menuCount = 0; @endphp
 	@foreach ($data['menues'] as $menu)
 	@if ($menuCount >= 4 && $menu->menu_id != "Get Services") <!-- Display remaining menus after the logo and "Get Services" -->
 	<a class="onepage-link" href="#{{ $menu->menu_id }}"><span>{{ $menu->menu }}</span></a>
 	@elseif($menu->menu == "Get Services")
 	<a class="onepage-link" href="javascript:void(0)" onclick="showModal()" id="get__modal"><span>{{ $menu->menu }} </span></a>
 	@endif
 	@php $menuCount++; @endphp
 	@endforeach
 </li>
<!-- Code Finalize -->