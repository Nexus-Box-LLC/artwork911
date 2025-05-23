<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="Front/assets/img/favicon.png">
	<title>ArtWork</title>
	@include('front.layouts.css')
</head>
<body>
	<div class="content-wrapper">
    	@include('front.layouts.header')
        <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="Front/assets/img/photos/bg3.jpg">
			<div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
			</div>
		</section>
        <section class="wrapper artwork-containers bg-light angled upper-end">
			<div class="container">
				<div class="row mb-14 mb-md-16">
					<div class="col-xl-12  mx-auto mt-n19">
						<div class="row">
                            <div class="col-md-3">
                                 @include('front.layouts.sidebar')
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="display-6 mb-3 text-white">Change Password</h3>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="{{route('user-dashboard')}}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="card" style="overflow:hidden;padding:20px;">

                                <div class="row">
                                        <div class="col-md-6">
                                            <form method="POST" data-ajax="update-user-password" data-target-button=".btn-change-password" data-allow-success class="text-start mb-3">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="password" class="form-control" name="currentpassword" placeholder="Enter current password" required data-error="Please enter password." />
                                                            <label>Current Password</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="password" class="form-control" name="newpassword" placeholder="Enter password" required data-error="Please enter new password." />
                                                            <label>New Password</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="password" class="form-control" name="newpasswordagain" placeholder="Enter confirm password" required data-error="Please enter confirm password." />
                                                            <label>Confirm Password</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="messages"></div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-primary rounded-pill btn-change-password w-100 mb-2">Change Password</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</section>
	</div>
	@include('front.layouts.footer')
	@include('front.layouts.scripts')
	</body>
</html>
