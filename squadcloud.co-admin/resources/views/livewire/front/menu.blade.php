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