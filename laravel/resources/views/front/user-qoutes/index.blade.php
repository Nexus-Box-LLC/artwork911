<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="Front/assets/img/favicon.png">
	<title>ArtWork| Quoets</title>
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
                                        <h3 class="display-6 mb-3 text-white">Quotes</h3>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <nav class="d-inline-block mt-7" aria-label="breadcrumb">
                                            <ol class="breadcrumb text-white">
                                                <li class="breadcrumb-item"><a href="{{route('user-dashboard')}}">Home</a></li>
                                                <li class="breadcrumb-item active">Quotes</li>

                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="card" style="overflow:hidden;padding:20px;">
                                    @php
										$is_digitizing_tab = true;
									@endphp

									@if(request()->filled('vectorizingorders'))
										@php
											$is_digitizing_tab = false;
										@endphp
									@endif

                                    <div class="hero-slider-wrapper">

                                            <div class="row">
                                                <div class="col-md-9">

                                                    <ul class="nav nav-tabs nav-pills">
                                                        <li class="nav-item">
                                                            <a class="nav-link @if($is_digitizing_tab) active @endif" data-bs-toggle="tab" href="#tab1-1">
                                                                <img src="{{asset('Front/assets/img/icons/clock-2.svg')}}" class="svg-inject icon-svg" alt="" />
                                                                <span> Digitizing quote</span>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link @if(!$is_digitizing_tab) active @endif" data-bs-toggle="tab" href="#tab1-2">
                                                                <img src="{{asset('Front/assets/img/icons/clock-2.svg')}}" class="svg-inject icon-svg" alt="" />
                                                                <span>Vectorizing quote</span>
                                                            </a>
                                                        </li>

                                                    </ul>


                                                </div>
                                                <div class="col-md-3 text-right">
                                                    <a class="btn btn-primary rounded-pill" href="{{route('create-qoute')}}" >
                                                        <img src="{{asset('Front/assets/img/icons/check-list.svg')}}" class="svg-inject icon-svg" alt="" />
                                                        <span>Create quote</span>
                                                    </a>
                                                </div>
                                            </div>



                                            <div class="tab-content">
                                                <div class="tab-pane fade @if($is_digitizing_tab) active show @endif" id="tab1-1">
                                                    <div class="row">
                                                        @if(count($digitizingorders) > 0 )
                                                            @foreach($digitizingorders as $digitizingorder)

                                                            <div class="col-md-4">

                                                                <div class="card">
                                                                    <figure class="card-img-top">
                                                                        <img class="img-h200 img-fx" src="https://artwork911.com/Front/assets/images/logo-colored.png" alt=""><span class="bg"></span>
                                                                    </figure>

                                                                    <div class="card-body">
                                                                        <div class="post-header">
                                                                            <h2 class="post-title h5 mt-0 mb-0">#{{$digitizingorder->order_number}}</h2>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-footer">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <i class="uil uil-calendar-alt"></i><span>{{ date('d M Y',strtotime($digitizingorder->created_at))}}</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <a href="{{ route('/')}}/qoute-details/{{$digitizingorder->id}}">View Details</a>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            @endforeach
                                                        @else
                                                            <h4 align="center">Pending Digitizing qoute not found</h4>
                                                        @endif
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <div class="pagination-block" style="margin-top:15px;">
                                                                {{ $digitizingorders->appends(['digitizingorders' => $digitizingorders->currentPage()])->links('front.orders.paginationlinks') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                 <div class="tab-pane fade @if(!$is_digitizing_tab) active show @endif" id="tab1-2">
                                                    <div class="row">
                                                        @if(count($vectorizingorders) > 0 )
                                                            @foreach($vectorizingorders as $vectorizingorder)
                                                            <div class="col-md-4">
                                                                <div class="card">
                                                                    <figure class="card-img-top">
                                                                        <img class="img-h200 img-fx" src="https://sandbox.elemisthemes.com/assets/img/photos/b4.jpg" alt=""><span class="bg"></span>
                                                                    </figure>

                                                                    <div class="card-body">
                                                                        <div class="post-header">
                                                                            <h2 class="post-title h5 mt-0 mb-0">#{{$vectorizingorder->order_number}}</h2>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-footer">

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <i class="uil uil-calendar-alt"></i><span>{{ date('d M Y',strtotime($vectorizingorder->created_at))}}</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <a href="{{ route('/')}}/qoute-details/{{$vectorizingorder->id}}">View Details</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @else
                                                            <h4 align="center">Pending Vectorizing qoute not found</h4>
                                                        @endif
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <div class="pagination-block" style="margin-top:15px;">
                                                                {{ $vectorizingorders->appends(['vectorizingorders' => $vectorizingorders->currentPage()])->links('front.orders.paginationlinks') }}
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
