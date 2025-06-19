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
                                        <h3 class="display-6 mb-3 text-white">Update Profile</h3>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="{{route('user-dashboard')}}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="card" style="overflow:hidden;padding:20px;">

                                <div class="row">
                                        <div class="col-md-6">
                                            <form method="POST" data-ajax="update-user" data-target-button=".btn-update-profile" data-allow-success class="text-start mb-3">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="text" class="form-control" value="{{ $user['first_name'] }}" name="first_name" placeholder="Enter first name" required data-error="Please enter first name"/>
                                                            <label>First Name</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="text" class="form-control" value="{{ $user['last_name'] }}" name="last_name" placeholder="Enter last name" required data-error="Please enter last name"/>
                                                            <label for="reg_lname">Last Name</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="text" class="form-control" value="{{ $user['username'] }}" name="username" placeholder="Enter username" required data-error="Please enter username." />
                                                            <label>Username</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="email" readonly class="form-control" value="{{ $user['email'] }}" name="email" placeholder="Enter email address" required data-error="Please enter valid email address." />
                                                            <label>Email Address</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="phone" class="form-control" value="{{ $user['phone'] }}" name="phone" placeholder="Enter phone number" required data-error="Please enter phone number." />
                                                            <label>Phone Number</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="messages"></div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <button class="btn btn-primary rounded-pill btn-update-profile w-100 mb-2">Save Details</button>
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
    <script>
        function ajax_success(target, data){
			if(target=="update-user"){
                window.location.href=window.location.href;
			}
        }
    </script>
	</body>
</html>
