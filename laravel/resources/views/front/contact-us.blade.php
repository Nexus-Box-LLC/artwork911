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
    <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="Front/assets/img/photos/bg3.jpg">
			<div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
				<div class="row">
					<div class="col-lg-8 mx-auto">
						<h1 class="display-1 mb-3 text-white">Get in Touch</h1>
						<p class="lead px-xl-10 px-xxl-10">Have any questions? <br />Reach out to us and we will get back to you shortly.</p>
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
                            <form method="POST" data-ajax="contact-us" data-target-button=".btn-contact-us" data-allow-success>
                                @csrf
                                <div class="controls">
                                    <br />
                                    <div class="row">
                                        <div class="col-md-7">
											<div class="row gx-4">
												<div class="col-md-12">
													<div class="form-label-group mb-4">
														<input id="form_fname" type="text" name="full_name" class="form-control" placeholder="Enter full name" required="required" data-error="Please enter full name.">
														<label for="form_fname">Full Name</label>
														<div class="help-block with-errors"></div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-label-group mb-4">
														<input id="form_email" type="email" name="email" class="form-control" placeholder="Enter email address" required="required" data-error="Valid email is required.">
														<label for="form_email">Email Address</label>
														<div class="help-block with-errors"></div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-label-group mb-4">
														<input id="form_phone" type="phone" name="phone" class="form-control" placeholder="Enter phone number" required="required" data-error="Valid phone number is required.">
														<label for="form_phone">Phone Number</label>
														<div class="help-block with-errors"></div>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-label-group mb-4">
														<input id="form_subject" type="text" name="subject" class="form-control" placeholder="Enter subject" required="required" data-error="Valid subject is required.">
														<label for="form_subject">Subject</label>
														<div class="help-block with-errors"></div>
													</div>
												</div>

												<div class="col-md-12">
													<div class="form-label-group mb-4">
														<textarea rows="5" id="form_message" type="text" name="message" class="form-control" placeholder="Enter message" required="required" data-error="Pleas enter message."></textarea>
														<label for="form_message">Message</label>
														<div class="help-block with-errors"></div>
													</div>
												</div>
                                                <div class="messages"></div>
												<div class="col-12">
													<button type="submit" class="btn btn-primary w-20 mb-2 btn-contact-us rounded-pill btn-send mb-3">Submit</button>
												</div>
												<!-- /column -->
											</div>
										</div>

										<div class="col-md-1"></div>

										<div class="col-md-4">

											<div class="d-flex flex-row">
												<div>
													<div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-envelope"></i> </div>
												</div>
												<div>
													<h5 class="mb-1">E-mail Addresses</h5>
													<br />
													<p class="mb-0"><strong style="color:#343f52">1) Customer Service</strong><br /> <a href="mailto:support@artwork911.com" class="link-body">support@artwork911.com</a></p>
													<br />
													<p class="mb-0"><strong style="color:#343f52">2) Orders</strong><br /><a href="mailto:orders@artwork911.com" class="link-body">orders@artwork911.com</a></p>
													<br />
													<p class="mb-0"><strong style="color:#343f52">3) Information E-mail</strong><br /><a href="mailto:info@artwork911.com" class="link-body">info@artwork911.com</a></p>
												</div>
											</div>

										</div>
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

</body>
</html>
