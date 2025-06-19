<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/img/favicon.png">
	<title>Register | ArtWork</title>

    @include('front.layouts.css')
</head>
<body>
	<div class="content-wrapper">

    @include('front.layouts.header')
    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="Front/assets/img/photos/bg3.jpg">
			<div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
				<div class="row">
					<div class="col-lg-8 mx-auto">
						<h1 class="display-1 mb-3 text-white">Register</h1>
                        <nav class="d-inline-block" aria-label="breadcrumb">
							<ol class="breadcrumb text-white">
								<li class="breadcrumb-item"><a href="{{route('user.login')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Register</li>
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
					<div class="col-xl-12 mx-auto mt-n19" style="margin-top: -12rem !important;">
                        <div class="card" style="padding:20px">
                            <form method="POST" data-ajax="user-register" data-target-button=".btn-register" data-allow-success>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-label-group form-group mb-4">
                                            <input type="text" class="form-control" name="first_name" placeholder="Enter first name" required data-error="Please enter first name." />
                                            <label for="reg_fname">First Name</label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group form-group mb-4">
                                            <input type="text" class="form-control" name="last_name" placeholder="Enter last name" required data-error="Please enter last name." />
                                            <label for="reg_lname">Last Name</label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-label-group form-group mb-4">
                                            <input type="text" class="form-control" name="username" placeholder="Enter username" required data-error="Please enter username." />
                                            <label for="reg_username">Username</label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group form-group mb-4">
                                            <input type="email" class="form-control" name="email" placeholder="Enter email address" required data-error="Please enter valid email address." />
                                            <label for="reg_email">Email Address</label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-label-group form-group mb-4">
                                            <input type="phone" class="form-control" name="phone" placeholder="Enter phone number" required data-error="Please enter phone number." />
                                            <label for="reg_phone">Phone Number</label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group form-group mb-4">
                                            <input type="text" class="form-control" name="promo_code" placeholder="Enter promo code" />
                                            <label for="reg_password">Promo Code(Optional)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-label-group form-group mb-4">
                                            <input type="password" class="form-control" name="password" placeholder="Enter password" required data-error="Please enter password." />
                                            <label for="reg_password">Password</label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group form-group mb-4">
                                            <input type="password" class="form-control" name="conf_password" placeholder="Enter confirm password" required data-error="Please enter confirm password." />
                                            <label for="reg_conf_password">Confirm Password</label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="messages"></div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <p class="mb-0 cv">Already have an account? <a href="{{route('user.login')}}" class="hover">Log In</a></p>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary btn-register rounded-pill w-100 mb-2">Register</button>
                                    </div>
                                </div>

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
