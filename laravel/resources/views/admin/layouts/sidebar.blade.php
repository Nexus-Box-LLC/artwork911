<style>
	#sidebar-menu ul ul a{
		padding: 12px 10px 12px 50px;
	}
	.side-menu{
		width:260px;
	}
</style>

<?php $user = Auth::guard('web')->user()?>

<div class="left side-menu">
	<button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
		<i class="ion-close"></i>
	</button>

	<!-- LOGO -->
	<div class="topbar-left">
		<div class="text-center">
			<a href="dashboard.php" class="logo"><img style="width: 60%;" src="{{asset('Admi/assets/images/logo-horizontal.svg')}}" /></a>
		</div>
	</div>
	<div class="sidebar-inner slimscrollleft">
		<div id="sidebar-menu">
		<li class="menu-title">Navigation Menu</li>
		<ul>
			@php
				$user = Auth::guard('web')->user();

				if($user){
					$role_id = $user->role_id;

					$has_menu = App\Models\Admin\Permission::select("menu_id")->where('role_id',$role_id)->get();

					$menu_id = json_decode(json_encode($has_menu), true);
					$menu_id = array_column($menu_id, "menu_id");
					
					$menus = App\Models\Admin\Menu::select("*")->where("type",0)->whereIn("id",$menu_id)->orderBy('sort_order', 'ASC')->get();
				}

			@endphp

			@if(isset($menus))
				@foreach ($menus as $menu)

					<li>
						<a href="https://artwork911.com/admin/{{$menu['route']}}" class="waves-effect">
							<i class="mdi {{$menu['icon']}}"></i>
							<span>{{$menu["name"]}}</span>
							<span class="float-right"></span>
						</a>
					</li>

				@endforeach
			@endif

		</ul>
		
		</div>
		<div class="clearfix"></div>
	</div> <!-- end sidebarinner -->
</div>
