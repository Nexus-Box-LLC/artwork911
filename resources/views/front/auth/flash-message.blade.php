@if ($message = Session::get('success'))
<div class="form-control" style="color: #0f5132;background-color: #d1e7dd;border-color: #badbcc;">
 <i class="fa fa-check"></i>   <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="form-control" style="#842029;background-color: #f8d7da;border-color: #f5c2c7;">
	<i class="fa fa-close"></i>  <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="form-control" style="color: #664d03;background-color: #fff3cd;border-color: #ffecb5;">
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="form-control" style="#055160;background-color: #cff4fc;border-color: #b6effb;">
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
<div class="form-control" style="#842029;background-color: #f8d7da;border-color: #f5c2c7;">
	Please check the form below for errors
</div>
@endif