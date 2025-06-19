<?php $user= Auth::guard('user')->user() ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="Front/assets/img/favicon.png">
	<title>ArtWork | Create Ticket</title>
	@include('front.layouts.css')
    <link rel="stylesheet" href="{{asset('Front/assets/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('Front/assets/css/fancybox.css')}}">
</head>
<body>
	<div class="content-wrapper">
    	@include('front.layouts.header')
        <section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-400 text-white" data-image-src="{{asset('Front/assets/img/photos/bg3.jpg')}}">
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
                                        <h3 class="display-6 mb-3 text-white">Create Ticket</h3>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="{{route('user-dashboard')}}">Home</a></li>
                                                <li class="breadcrumb-item"><a href="{{route('manage-tickets')}}">Tickets</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Create</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="card"style="overflow:hidden;padding:20px">
                                    <div class="hero-slider-wrapper ">
                                            <form method="POST" data-ajax="create-ticket" data-target-button=".btn-user-ticket" data-allow-success class="text-start mb-3" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="text" class="form-control" placeholder="Enter design name" name="title" required data-error="Please enter design name" />
                                                            <label>Title *</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-label-group form-group mb-4">
                                                            <input type="text" class="form-control" placeholder="Enter order number" name="order_number"  required data-error="Please enter order number" />
                                                            <label for="reg_po">Order number</label>
															<div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                     <div class="col-md-6">
                                                        <div class="form-label-group form-group mb-4">
                                                            <select class="form-control" required data-error="Please select required file format" name="reason">
                                                                <option value="">Select reason</option>
                                                                <option value="0">Order related</option>
                                                                <option value="1">Payment related</option>
                                                            </select>
                                                            <label>Required Reason *</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input class="form-control" type="file" name="attachment" required data-error="Please select the file" />
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-label-group form-group mb-4">
                                                            <textarea placeholder="Enter specific details" required data-error="Please enter message" name="message" class="form-control" rows="5"></textarea>
                                                            <label>Message*</label>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                   <div class="messages"></div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <button class="btn btn-primary rounded-pill w-100 mt-3 btn-user-ticket">Submit</button>
                                                        </div>
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

    <script src="{{asset('Front/assets/js/select2.min.js')}}"></script>
	<script src="{{asset('Front/assets/js/fancybox.js')}}"></script>
    <script src="{{asset('Front/assets/js/form-plugin.js')}}"></script>
    <script src="{{asset('Front/assets/js/validator.min.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
        $(document).ready(function(){

            $("select[name='reason']").select2({
                width: '100%',
                placeholder:'Select The Reason'
            });
    });
        </script>
	</body>
</html>
