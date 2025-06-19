<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>ArtWork | Admin</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{asset('Admi/assets/images/favicon.ico')}}">
		<link href="{{asset('Admi/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('Admi/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('Admi/assets/css/style.css')}}" rel="stylesheet" type="text/css">

		<style>
			.progress-overlay{
				position:absolute;
				top:0px;
				left:0px;
				width:100%;
				height:100%;
				background:#ffffffe3;
				z-index: 999;
				display:none;
			}
			.progress-overlay.show{
				display:block;
			}
			.progress-overlay div{
				margin-top: 38%;
				text-align: center;
				font-size: 18px;
			}
		</style>
	</head>
    <body class="fixed-left">
		<!-- Begin page -->
		<div class="accountbg"></div>
		<div class="wrapper-page">
			<div class="card">
				<div class="progress-overlay"><div>Please wait...</div></div>
				<div class="card-body">
					<h3 class="text-center mt-0 m-b-15">
						<a href="#" class="logo"><img style="width: 60%;" src="{{asset('Admi/assets/images/logo-horizontal.svg')}}" /></a>
					</h3>
					<div class="p-3">
						<form class="form-horizontal m-t-10" action="{{ route('login') }}" method="POST">
							@csrf
							<div class="form-group row">
								<div class="col-12">
									<input class="form-control" type="text" required name="email" placeholder="Username">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-12">
									<input class="form-control" type="password" required name="password" placeholder="Password">
								</div>
							</div>
							 
				           <div class="form-group row">
							 @include('admin.auth.flash-message')	 
								<div class="form-group col-12 text-center">
									<button class="btn btn-success btn-block waves-effect waves-light" type="submit">Log In</button> 
								</div>
								<div class="col-sm-7">
									<a href="{{route('forget.password.admin.get')}}" class="text-muted text-center"><i class="mdi mdi-lock"></i> Forgot your password ?</a>
								</div>
							</div>
										
						</form>
					</div>
				</div>
			</div>
		</div>	
		<script src="{{asset('Admi/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('Admi/assets/js/popper.min.js')}}"></script>
        <script src="{{asset('Admi/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('Admi/assets/js/modernizr.min.js')}}"></script>
        <script src="{{asset('Admi/assets/js/detect.js')}}"></script>
        <script src="{{asset('Admi/assets/js/fastclick.js')}}"></script>
        <script src="{{asset('Admi/assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('Admi/assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('Admi/assets/js/waves.js')}}"></script>
        <script src="{{asset('Admi/assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('Admi/assets/js/jquery.scrollTo.min.js')}}"></script>
		<script src="{{asset('Admi/assets/js/app.js')}}"></script>
		<script src="{{asset('Admi/assets/plugins/alertify/js/alertify.js')}}"></script>
	</body>

</html>
