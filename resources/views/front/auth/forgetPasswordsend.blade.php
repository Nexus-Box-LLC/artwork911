<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/img/favicon.png">
	<title>Forget password | ArtWork</title>

    @include('front.layouts.css')
</head>
<body>
	<div class="content-wrapper">

    @include('front.layouts.header')
        <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="{{asset('Front/assets/img/photos/bg3.jpg')}}">
			<div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
				<div class="row">
					<div class="col-lg-8 mx-auto">
						<h1 class="display-1 mb-3 text-white">Forgot Password?</h1>
						<nav class="d-inline-block" aria-label="breadcrumb">
							<ol class="breadcrumb text-white">
								<li class="breadcrumb-item"><a href="{{route('user.login')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Forget Password</li>
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
                            <form method="POST" data-ajax="forget-password" data-target-button=".btn-forget-password" data-allow-success>
                                @csrf
                                <div class="form-label-group form-group mb-4">
                                    <input type="email" class="form-control" name="email" placeholder="Enter email address" required data-error="Valid email is required." />
                                    <label> Email Address</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="messages"></div>
                                <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btn-forget-password rounded-pill btn-fp w-100 mb-2">Reset Password</button>
                                <p class="mb-1"><a  href="{{route('user.login')}}" class="hover">Log in</a></p>
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

</body>
</html>
