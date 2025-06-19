<!DOCTYPE html>
<html>
	<head>
		<title>ArtWork | @yield('title')</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@include('admin.layouts.css')
		@yield('style')
	</head>
	<body class="fixed-left">
		@include('admin.layouts.pre-loader')
		<div id="wrapper">
		@include('admin.layouts.sidebar')
			<div class="content-page">
				<div class="content">
					@include('admin.layouts.header')
		 			<div class="page-content-wrapper">
						<div class="container-fluid">
						 	<div class="row">
								<div class="col-sm-12">
									<div class="page-title-box">
										<div class="btn-group float-right">
											<ol class="breadcrumb hide-phone p-0">
												<li class="breadcrumb-item"><a href="{{route('dashboard')}}">ArtWork</a></li>
												@yield('breadcrumb-items')
											</ol>
										</div>
										<h4 class="page-title">@yield('breadcrumb-title')</h4>
									</div>
								</div>
							</div>
 						@yield('content')
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('admin.layouts.footer')   
	@include('admin.layouts.script')  
  </body>
</html>