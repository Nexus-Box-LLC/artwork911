<?php $user = Auth::guard('user')->user() ?>
<div class="card left-nav-menu">
    <div class="profile-section display-6">
        <label class="username">{{$user->first_name}}<br /><label class="art-email">{{$user->email}}</label></label>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('create-digitizing-order')}}"><img src="{{asset('Front/assets/img/icons/paper-plane.svg')}}" class="svg-inject icon-svg" alt="" /> Place New Digitizing Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('create-artwork-order')}}"><img src="{{asset('Front/assets/img/icons/paper-plane.svg')}}" class="svg-inject icon-svg" alt="" /> Place New Vectorizing Order</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('pending-orders')}}"><img src="{{asset('Front/assets/img/icons/clock-2.svg')}}" class="svg-inject icon-svg" alt="" /> Pending Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('inprogress-orders')}}"><img src="{{asset('Front/assets/img/icons/clock-2.svg')}}" class="svg-inject icon-svg" alt="" /> Orders in Progress</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('awaiting-orders')}}"><img src="{{asset('Front/assets/img/icons/clock-2.svg')}}" class="svg-inject icon-svg" alt="" /> Awaiting Approval</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('completed-orders')}}"><img src="{{asset('Front/assets/img/icons/check.svg')}}" class="svg-inject icon-svg" alt="" /> Completed Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('qoutes')}}"><img src="{{asset('Front/assets/img/icons/check-list.svg')}}" class="svg-inject icon-svg" alt="" /> Quotes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=""><img src="{{asset('Front/assets/img/icons/show.svg')}}" class="svg-inject icon-svg" alt="" /> View / Download Invoices</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('update-user-profile')}}"><img src="{{asset('Front/assets/img/icons/user.svg')}}" class="svg-inject icon-svg" alt="" /> Update Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('change-get-user-password')}}"><img src="{{asset('Front/assets/img/icons/lock.svg')}}" class="svg-inject icon-svg" alt="" /> Change Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('manage-tickets')}}"><img src="{{asset('Front/assets/img/icons/telemarketer.svg')}}" class="svg-inject icon-svg" alt="" /> Customer Service</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#modal-logout" href="javascript:void(0);"><img src="{{asset('Front/assets/img/icons/loading.svg')}}" class="svg-inject icon-svg" alt="" /> Logout</a>
        </li>
    </ul>
</div>
