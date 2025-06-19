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
                                        <h3 class="display-6 mb-3 text-white">Dashboard</h3>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="{{route('user-dashboard')}}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="card" style="overflow:hidden">

                                    <div class="hero-slider-wrapper bg-dark">
                                        <div class="hero-slider owl-carousel dots-over" data-nav="false" data-dots="true" data-autoplay="true">
                                            <div class="owl-slide d-flex align-items-center bg-overlay bg-overlay-400" style="height:514px;background-image: url(https://qdigitizing.com/images/p-Banner.jpg);">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-11 offset-md-1 text-center text-lg-start">
                                                            <h4 class="display-1 fs-56 mb-4 text-white animated-caption" data-anim="animate__slideInDown" data-anim-delay="500">We bring solutions to make life easier.</h4>
                                                            <p class="lead fs-23 lh-sm mb-7 text-white animated-caption" data-anim="animate__slideInRight" data-anim-delay="1000">We are a creative company that focuses on long term relationships with customers.</p>
                                                            <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500"><a href="#" class="btn btn-lg btn-outline-white rounded-pill">Read More</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="owl-slide d-flex align-items-center bg-overlay bg-overlay-400" style="height:514px;background-image: url(https://qdigitizing.com/images/Transfers-Banner2.jpg);">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-11 offset-md-1 text-center text-lg-start">
                                                            <h4 class="display-1 fs-56 mb-4 text-white animated-caption" data-anim="animate__slideInDown" data-anim-delay="500">We bring solutions to make life easier.</h4>
                                                            <p class="lead fs-23 lh-sm mb-7 text-white animated-caption" data-anim="animate__slideInRight" data-anim-delay="1000">We are a creative company that focuses on long term relationships with customers.</p>
                                                            <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500"><a href="#" class="btn btn-lg btn-outline-white rounded-pill">Read More</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
