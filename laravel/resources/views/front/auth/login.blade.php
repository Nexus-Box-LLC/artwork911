<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/img/favicon.png">
	<title>Login | ArtWork</title>

    @include('front.layouts.css')
</head>
<body>
	<div class="content-wrapper">

    @include('front.layouts.header')
        <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="{{asset('Front/assets/img/photos/bg3.jpg')}}">
			<div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
				<div class="row">
					<div class="col-lg-8 mx-auto">
						<h1 class="display-1 mb-3 text-white">Log In to Account</h1>
						<nav class="d-inline-block" aria-label="breadcrumb">
							<ol class="breadcrumb text-white">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Log In</li>
							</ol>
						</nav>
						<!-- /nav -->
					</div>
					<!-- /column -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</section>

		<section class="wrapper bg-light angled upper-end">
			<div class="container pb-11">
				<div class="row mb-14 mb-md-16">
					<div class="col-xl-4 mx-auto mt-n19" style="margin-top: -12rem !important;">
                        <div class="card" style="padding:20px">
                            <form method="POST" data-ajax="user-login" data-target-button=".btn-login-page" data-allow-success>
                                @csrf
                                <div class="controls">
                                    <br />
                                    <div class="row gx-4">
                                        <div class="col-md-12">
                                            <div class="form-label-group form-group mb-4">
                                                <input  type="email" name="email" class="form-control" placeholder="Enter email address" required data-error="Valid email is required.">
                                                <label>Username / Email Address</label>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-label-group form-group mb-4">
                                                <input type="password" name="password" class="form-control" placeholder="Enter password" required data-error="Valid email is required.">
                                                <label>Password</label>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="messages"></div>
                                        <div class="col-12 text-center">
                                            @if(session()->has('message'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('message') }}
                                                </div>
                                            @endif
                                            @if(session()->has('success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('success') }}
                                                </div>
                                            @endif
                                            <button type="submit" class="btn btn-primary w-100 mb-2 btn-login-page rounded-pill btn-send mb-3">Log In</button>
                                            <p class="mb-1"><a  href="{{route('forget.password.get')}}" class="hover">Forgot Password?</a></p>
                                            <p class="mb-0">Don't have an account? <a href="{{route('user-register')}}" class="hover">Sign up</a></p>
                                        </div>
                                        <!-- /column -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.controls -->
                            </form>
						</div>
						<!-- /.card -->
					</div>
					<!-- /column -->
				</div>

			</div>
			<!-- /.container -->
		</section>

	</div>
	<!-- /.content-wrapper -->

    @include('front.layouts.footer')

    @include('front.layouts.scripts')

    <script>
        function ajax_success(target, data){
			if(target=="user-login"){
                window.location.href="/user-dashboard";
			}
        }
    </script>
</body>
</html>
