<header class="wrapper bg-soft-primary">
    <nav class="navbar center-nav transparent position-absolute navbar-expand-lg navbar-dark">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100"><a href="{{route('user-dashboard')}}">
                <img class="logo-dark" src="{{asset('Front/assets/images/logo-colored.png')}}" srcset="{{asset('Front/assets/images/logo-colored.png')}} 2x" alt="" />
                <img class="logo-light" src="{{asset('Front/assets/img/logo-white.png')}}" srcset="{{asset('Front/assets/img/logo-white.png')}} 2x" alt="" style="height: 65px;"/></a></div>
            <div class="navbar-collapse offcanvas-nav">
                <div class="offcanvas-header d-lg-none d-xl-none">
                    <a href="{{route('user-dashboard')}}"><img src="{{asset('Front/assets/images/logo-white.png')}} 2x" srcset="{{asset('Front/assets/images/logo-white.png')}}" style="height: 60px;"/></a>
                    <button type="button" class="btn-close btn-close-white offcanvas-close offcanvas-nav-close" aria-label="Close"></button>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{route('user-dashboard')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Embroidery Digitizing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Art Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('contact-us')}}">Contact Us</a></li>
					@if(Auth::guard('user')->user())
                    <li class="nav-item"><a class="nav-link" href="{{route('user-dashboard')}}">My Account</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#modal-logout" href="javascript:void(0);">Logout</a></li>

					@else
					<li class="nav-item"><a class="nav-link" href="{{route('user.login')}}">Log In</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('user.register')}}">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
