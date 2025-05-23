<?php $user = Auth::guard('web')->user()?>
 <style>
	.profile-dropdown{
		width: 190px !important;
	}
 </style>
 <div class="topbar">
	<nav class="navbar-custom">
		<ul class="list-inline float-right mb-0">
			<li class="list-inline-item dropdown notification-list">
				<a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
				   aria-haspopup="false" aria-expanded="false" style="color: #FFF;">

				   	@if (!empty($user->profile_image))
					   <img class="rounded-circle" src="{{ URL::to('/') }}/Admi/admin_profile_image/{{$user->profile_image}}" style="width: 30px;">&nbsp;&nbsp;
					@else
						<i class="mdi mdi-account-circle" style="position: relative;top: 4px;font-size: 25px;"></i>
					@endif
                    @if($user->type==1)
                        {{$user->username}} (<span>Super Admin</span>)
                    @else
                        {{$user->username}}
                    @endif
					</a>

				<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5>Welcome</h5>
					</div>
					<a class="dropdown-item" href="{{ route('update-password') }}"><i class="mdi mdi-key m-r-5 text-muted"></i>  Change Password</a>
					<a class="dropdown-item" href="{{ route('update-profile')}}"><i class="mdi mdi-account  m-r-5 text-muted"></i>  Update Profile</a>
					<a class="dropdown-item" href="{{ route('signout') }}"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
				</div>
			</li>
		</ul>
		<ul class="list-inline menu-left mb-0">
			<li class="float-left">
				<button class="button-menu-mobile open-left waves-light waves-effect">
					<i class="mdi mdi-menu"></i>
				</button>
			</li>
		</ul>
		<div class="clearfix"></div>
	</nav>
</div>
