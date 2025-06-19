@extends('admin.layouts.master')
@section('title', 'Manage Discount')

@section('css')
<link href="{{asset('Admi/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('Admi/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('breadcrumb-title')
Manage Discount
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Manage Discount</li>
@endsection

@section('content')
	<div class="row">
        <div class="form-group col-md-12">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        </div>
		<div class="col-lg-12 col-md-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-remove"></span>{{ $error }}
                </div>
            @endforeach
            <div class="card m-b-30">
				<div class="collapse m-b-20" id="add-new-coupon">
					<div class="card-body">
						<h4 class="header-title mt-0 mb-0">Add Coupon</h4>
					</div>
					<div class="card-body card-colored">
						<form method="POST" action="{{route('add-coupon')}}">
						@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Title</label>
												<input type="text" name="title" value="{{ old('title') }}" placeholder="Enter title" class="form-control" required />
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Code</label>
												<input type="text" name="code" value="{{ old('code') }}" placeholder="Enter code" class="form-control" required />
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Percentage</label>
												<input type="text" name="percentage" value="{{ old('percentage') }}" placeholder="Enter percentage" class="form-control" required />
											</div>
										</div>
										<div class="col-md-3">
											<label>Expiry date</label><br/>
											<div class="input-group">
												<input type="text" class="form-control" name="expiry_date" id="datepicker" placeholder="dd-mm-yyyy" required />
												<div class="input-group-append bg-custom b-0">
													<span class="input-group-text">
														<i class="mdi mdi-calendar"></i>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>No of usage per account</label>
												<input type="number" name="no_of_usage_per_account" value="{{ old('no_of_usage_per_account') }}" placeholder="Enter number of usage per account" class="form-control" required />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<button type="button" class="btn btn-danger" href="#add-new-coupon" data-toggle="collapse" aria-expanded="true">
											<i class="fa fa-close"></i> Cancel</button>
											<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add New Coupon</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
                <div class="card-body">
					<h4 class="header-title mt-0 mb-0 pull-left">Coupons List</h4>
					<a href="#add-new-coupon" data-toggle="collapse" aria-expanded="false" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add New Coupon</a>
				</div>

				<div class="card-body p0">
					<table id="id-tbl-coupons" style="width:100%" class="table table-bordered">
						<thead>
							<tr>
								<th width="30%">Title</th>
								<th width="30%">Code</th>
								<th width="10%">Percentage</th>
								<th width="10%">Expiry date</th>
								<th width="10%">Number of usage</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
                </div>
			</div>
		</div>
	</div>
	
	<div class="modal fade show" style="overflow: auto;display: none;background: opacity: 0.5;" id="updateModal" data-keyboard="false" data-backdrop="static"  tabindex="-1" role="dialog">
       <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background: #;min-height: 200px;border-radius: 15px;">
				<div class="modal-header">
					<h5 class="modal-title">Update Coupon</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>

				<div class="modal-body">
                    <div id="loader">
                        @include('admin.layouts.pre-loader')
                    </div>
					 
					<form action="{{route('update-coupon')}}" method="POST">
						@csrf
						<input type="hidden" name="id" />
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Title</label>
									<input type="text" name="title" id="title" placeholder="Enter title" class="form-control" required />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Code</label>
									<input type="text" name="code" id="code" placeholder="Enter code" class="form-control" required />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Percentage</label>
									<input type="text" name="percentage" id="percentage" placeholder="Enter percentage" class="form-control" required />
								</div>
							</div>
							<div class="col-md-6">
								<label>Start Date</label><br/>
								<div class="input-group">
									<input type="text" class="form-control" name="expiry_date" id="datepicker1" placeholder="dd-mm-yyyy" required />
									<div class="input-group-append bg-custom b-0">
										<span class="input-group-text">
											<i class="mdi mdi-calendar"></i>
										</span>
									</div>
								</div>
							</div>
						</div>	
						<div class="row">	
							<div class="col-md-6">
								<div class="form-group">
									<label>No of usage per account</label>
									<input type="number" name="no_of_usage_per_account" id="no_of_usage_per_account" placeholder="Enter number of usage per account" class="form-control" required />
								</div>
							</div>
						</div>	
						<div class="row">	
							<div class="col-md-12 text-right">
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
								<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div id="confirmModal" data-backdrop="static" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content" style="border-radius: 15px;">
				<div class="modal-header">
						<h5 class="modal-title">Confirmation</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					</div>
				<div class="modal-body">
					<h4 style="margin:0;">Delete Coupons?</h4>
				</div>
				<div class="modal-footer">
					<form method="POST" action="{{route('remove-coupon')}}">
						@csrf
						<input type="hidden" name="id" />
						<button class="btn btn-success" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
						<button class="btn btn-danger" type="submit"><i class="fa fa-check"></i> Yes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('script')
	<script src="{{asset('Admi/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('Admi/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('Admi/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('Admi/assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('Admi/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('Admi/assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('Admi/assets/plugins/select2/select2.min.js')}}"></script>
	<script src="{{asset('Admi/assets/js/ajax-loading.js')}}"></script>
	<script src="{{asset('Admi/assets/plugins/alertify/js/alertify.js')}}"></script>
	<script src="{{asset('Admi/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

	<script>
		$(document).ready(function(){
			
			$("#datepicker").datepicker({
				format: "dd-mm-yyyy"
			})
			$("#datepicker1").datepicker({
				format: "dd-mm-yyyy"
			})

			$.ajaxSetup({
				headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
			});

			var tbl_coupons = $('#id-tbl-coupons').DataTable({
				processing: true,
				servrSide: true,
				"searching": true,
					language: {
					search: "_INPUT_",
						searchPlaceholder: "Search coupons"
					},
					ajax:{
						url: "{{route('get-coupon')}}",
					},
					columns:[
						{
							data:'title',
						},
						{
							data:'code',
						},
						{
							data:'percentage',
							className: 'text-center'
						},
						{
							data:'expiry_date',
						},
						{
							data:'no_of_usage_per_account',
							className: 'text-center'
						},
						{
							data: null,
							render: function(data, type, full, meta){
								var button = "";

									button = '<button type="button" name="edit" data-id="'+ data.id +'" class="edit btn btn-dark btn-sm" data-toggle="modal" data-target="#updateModal"><i class="fa fa-pencil"></i> Edit</button>&nbsp;&nbsp;';
									button += '<button type="button" name="delete" data-id="'+ data.id +'" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i>  Delete</button><br />';

								return button;
							},
							orderable: false
						}
					]
			});
			
			$(document).on('shown.bs.modal', '#updateModal', function (e) {
				
				var id = $(e.relatedTarget).attr('data-id');
				
				$.ajax({
					url :"{{ route('/') }}/admin/get-specific-coupon/"+id,
					dataType:"json",
					beforeSend: function() {
						$("#loader").css("display", "block");
					},
					success:function(data){
						
						$("#updateModal input[name='title']").val(data.result.title);
						$("#updateModal input[name='code']").val(data.result.code);
						$("#updateModal input[name='percentage']").val(data.result.percentage);
						$("#updateModal input[name='expiry_date']").val(data.expiry_date);
						$("#updateModal input[name='no_of_usage_per_account']").val(data.result.no_of_usage_per_account);

						$("#updateModal input[name='id']").val(id);

						$("#loader").css("display", "none");
					}
				});
			});

			$(document).on('shown.bs.modal', '#confirmModal', function (e) {
				var id = $(e.relatedTarget).attr('data-id');
				$("#confirmModal input[name='id']").val(id);
			});

			$('#add-new-coupon').on('hidden.bs.collapse', function () {
				// show the button
				$("a[href='#add-new-coupon']").removeClass("hide");
			});

			$('#add-new-coupon').on('shown.bs.collapse', function () {
				// hide the button
				$("a[href='#add-new-coupon']").addClass("hide");
			});

		});
	</script>
@endsection
