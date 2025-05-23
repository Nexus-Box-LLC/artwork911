@extends('admin.layouts.master')
@section('title', 'Manage Prices')

@section('css')
	<style>
		.hide{
			display:none;
		}
	</style>
@endsection

@section('breadcrumb-title')
Manage Prices
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Manage Prices</li>
@endsection

@section('content')
	<div class="col-md-12 text-left">
		@foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-remove"></span>{{ $error }}
            </div>
        @endforeach
		@if(session()->has('error'))
			<div class="alert alert-danger">
				{{ session()->get('error') }}
			</div>
		@endif
			@if(session()->has('success'))
			<div class="alert alert-success">
				{{ session()->get('success') }}
			</div>
		@endif
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="card m-b-30">
				<div class="card-body">
					<h4 class="header-title mt-0 mb-0">Manage Prices</h4>
				</div>
				<div class="card-body p0">

				<ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1-1" role="tab" aria-selected="true">Digitizing Price</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2-2" role="tab" aria-selected="false">Vectorizing price</a></li>
                </ul>

				<div class="tab-content">
					<div class="tab-pane p-3 active" id="tab1-1" role="tabpanel">
						<form method="POST" action="{{route('digitizing-price')}}">
						@csrf
							<div class="row">
								<div class="col-md-12">
									<table class="p-0 table table-bordered tablex tbl-types-of-ink" style="width:80%">
										<thead>
											<tr>
												<th width="20%">Placement name</th>
												<th width="20%">Price</th>
												<th width="20%">Max width</th>
												<th width="20%">Max height</th>
											<!--<th width="10%">#</th>-->
											</tr>
										</thead>
										<tbody>
										 @if(count($dprice) > 0 )
											@foreach($dprice as $price)
												<tr class="item">
													<td>
														<input type="hidden" name="id[]" value="{{$price->id}}" class="form-control" required />
														<!--<select name="placement[]" class="form-control">
															<option value="">Select Placement</option>
															<option value="Left Chest Logos" @if($price->placement == "Left Chest Logos") selected @endif >Left Chest Logos</option>
															<option value="Jacket Back" @if($price->placement == "Jacket Back") selected @endif >Jacket Back</option>
															<option value="Sleeve" @if($price->placement == "Sleeve") selected @endif >Sleeve</option>
															<option value="Cap" @if($price->placement == "Cap") selected @endif >Cap</option>
															<option value="Back yoke" @if($price->placement == "Back yoke") selected @endif >Back yoke</option>
															<option value="Cuff" @if($price->placement == "Cuff") selected @endif >Cuff</option>
															<option value="Full Front" @if($price->placement == "Full Front") selected @endif>Full Front</option>
															<option value="Edit" @if($price->placement == "Edit") selected @endif >Edit</option>
														</select>-->
                                                        <input type="hidden" name="placement[]" value="{{$price->placement}}" class="form-control" required />
                                                        <b><p>{{$price->placement}}</p></b>
													</td>
													<td>
														<input type="text" name="price[]" value="{{$price->price}}" placeholder="Enter Price" class="form-control" />
													</td>
													<td>
														<input type="text" name="width[]" value="{{$price->max_width}}" placeholder="Enter width" class="form-control" />
													</td>
													<td>
														<input type="text" name="height[]" value="{{$price->max_height}}" placeholder="Enter height" class="form-control" />
													</td>
													<!--<td class="text-center">
														<button type="button" class="btn-remove-types-of-ink btn btn-small btn-danger">
														<i class="fa fa-close"></i></button>
													</td>-->
												</tr>
											@endforeach
											 @else
												 <tr class="empty <?=( !empty($price) ? "hide" : "" )?>">
													<td colspan="5">
														<h5 align="center">Digitizing prices not found</h5>
													</td>
												</tr>
												@endif
										</tbody>
									</table>
								</div>
								<!--<div class="col-md-12 text-right">
									<br />
									<button type="button" class="add-new-type-of-ink btn btn-info btn-xs"><i class="fa fa-plus"></i> Add Placement</button>
								</div>-->
								<div class="col-md-12 text-left">
									<br />
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save placement</button>
								</div>
							</div>
						</form>

					</div>
					<div class="tab-pane p-3" id="tab2-2" role="tabpanel">
						<form method="POST" action="{{route('vectorizing-price')}}">
						@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<input type="hidden" name="id" value="{{$vprice[0]['id']}}">
											<div class="col-md-3">
												<div class="form-group">
													<label>Simple</label>
													<input type="text" name="simple" value="{{$vprice[0]['simple']}}" placeholder="Enter Simple" class="form-control" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Complex</label>
													<input type="text" name="complex" value="{{$vprice[0]['complex']}}" placeholder="Enter complex" class="form-control" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Logo Design</label>
													<input type="text" name="logo_design" value="{{$vprice[0]['logo_design']}}" placeholder="Enter logo design" class="form-control" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label>Color separate</label>
													<input type="text" name="color_sepration" value="{{$vprice[0]['color_seprater']}}" placeholder="Enter color sepration" class="form-control" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save Placement</button>
											</div>
										</div>
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

@endsection

@section('script')


<script>

$(document).ready(function(){

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


/*	function empty_ink_types(){
		if( $(".tbl-types-of-ink tbody tr.item").length ==0 ){
			$(".tbl-types-of-ink tbody tr.empty").removeClass("hide");
		}else{
			$(".tbl-types-of-ink tbody tr.empty").addClass("hide");
		}
	}

	$(document).on("click",".btn-remove-types-of-ink", function(){

		$(this).closest("tr").remove();

		empty_ink_types();

	});


	$(document).on("click",".add-new-type-of-ink", function(){
		$(".tbl-types-of-ink tbody").append(
			$("<tr>").attr("class","item").append(
				$("<td>").append(
					$("<input>").attr("type","hidden").attr("name","id[]").val("-1")
				).append(
					$("<select>").attr("class","form-control").attr("name","placement[]")
						.append('<option value="">Select Placement</option>')
						.append('<option value="Left Chest Logos">Left Chest Logos</option>')
						.append('<option value="Jacket Back">Jacket Back</option>')
						.append('<option value="Sleeve">Sleeve</option>')
						.append('<option value="Cap">Cap</option>')
						.append('<option value="Back yoke">Back yoke</option>')
						.append('<option value="Cuff">Cuff</option>')
						.append('<option value="Full Front">Full Front</option>')
						.append('<option value="Edit">Edit</option>')
				)
			).append(
				$("<td>").append(
					$("<input>")
						.attr("type","text")
						.attr("name","price[]")
						.attr("placeholder","Enter price")
						.attr("class","form-control")

				)
			).append(
				$("<td>").append(
					$("<input>")
						.attr("type","text")
						.attr("name","width[]")
						.attr("placeholder","Enter width")
						.attr("class","form-control")

				)
			).append(
				$("<td>").append(
					$("<input>")
						.attr("type","text")
						.attr("name","height[]")
						.attr("placeholder","Enter height")
						.attr("class","form-control")

				)
			).append(
				$("<td>").attr("class","text-center").append(
					$("<button>")
						.attr("type","button")
						.attr("class","btn-remove-types-of-ink btn btn-small btn-danger")
						.html('<i class="fa fa-close"></i>')
				)
			)
		);

		empty_ink_types();

	});*/
});
</script>

@endsection



