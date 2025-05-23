<div class="form-group col-md-12">
	@foreach ($errors->all() as $error)
	<div class="alert alert-danger">
		<span class="glyphicon glyphicon-remove"></span>{{ $error }}
	</div>
	@endforeach
	@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
	@endif
	@if(session()->has('error'))
	<div class="alert alert-danger">
		{{ session()->get('error') }}
	</div>
	@endif
</div>