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
						<h1 class="display-1 mb-3 text-white">Reset Password</h1>
						<nav class="d-inline-block" aria-label="breadcrumb">
							<ol class="breadcrumb text-white">
								<li class="breadcrumb-item"><a href="{{route('user.login')}}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Reset Password</li>
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
                            <form method="POST" data-ajax="reset-password" data-target-button=".btn-reset-password" data-allow-success>
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="controls">
                                    <br />
                                    <div class="row gx-4">
                                        <div class="col-md-12">
                                            <div class="form-label-group mb-4">
                                                <input type="password" name="password" class="form-control" placeholder="Enter password" required data-error="Valid email is required.">
                                                <label>Password</label>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-label-group mb-4">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter password" required data-error="Valid email is required.">
                                                <label>Confirm Password</label>
                                                <div class="help-block with-errors"></div>
                                           </div>
                                        </div>
                                        <div class="messages"></div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary btn-reset-password w-100 mb-2 btn-login-page rounded-pill btn-send mb-3">Reset Password</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
            </div>
		</section>
    </div>
	@include('front.layouts.footer')
    @include('front.layouts.scripts')
    <script>
        function ajax_success(target, data){
                if(target=="reset-password"){
                    setTimeout(function(){
                        window.location.href="/user-login";
                }, 3000);
            }
        }
    </script>
</body>
</html>

