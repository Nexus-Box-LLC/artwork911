@extends('admin.layouts.master')
@section('title', 'Manage Affiliate')

@section('css')
<link href="{{asset('Admi/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb-title')
Manage Affiliate
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Manage Affiliate</li>
@endsection

@section('content')
	<div class="row">
		@include('admin.auth.flash-message')
        <div class="col-lg-12 col-md-12">
            <div class="card m-b-30">
				<div class="collapse m-b-20" id="add-new-affiliate">
					<div class="card-body">
						<h4 class="header-title mt-0 mb-0">Add Affiliate</h4>
					</div>
					<div class="card-body card-colored">
						<form method="POST" action="{{route('add-affiliate')}}">
						@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Company Name</label>
												<input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Enter company name"   class="form-control" required />
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Email</label>
												<input type="text" name="email" value="{{ old('email') }}" placeholder="Enter email address"   class="form-control" required />
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Phone</label>
												<input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number"   class="form-control" required />
											</div>
										</div>
                                        <div class="col-md-3 password_field">
											<div class="form-group">
												<label>Maain Contact Name</label>
												<input type="text" name="contact_name" value="{{ old('phone') }}" placeholder="Enter contact name" class="form-control" required />
											</div>
										</div>

										<div class="col-md-6">
											<button type="button" class="btn btn-danger" href="#add-new-affiliate" data-toggle="collapse" aria-expanded="true">
											<i class="fa fa-close"></i> Cancel</button>
											<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add New Affiliate</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
                <div class="card-body">
					<h4 class="header-title mt-0 mb-0 pull-left">Affiliate List</h4>
					<a href="#add-new-affiliate" data-toggle="collapse" aria-expanded="false" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add New Affiliate</a>
				</div>

				<div class="card-body p0">
					<table id="id-affiliate" style="width:100%" class="table table-bordered">
						<thead>
							<tr>
								<th width="10%">Created Date</th>
								<th width="20%">Company Name</th>
								<th width="10%">Phone</th>
								<th width="10%">Email</th>
								<th width="10%">Main contact name</th>
								<th width="30%">link</th>
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
					<h5 class="modal-title">Update Affiliate</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>

				<div class="modal-body">
                    <div id="loader">
                        @include('admin.layouts.pre-loader')
                     </div>
					<form action="{{route('update-affiliate')}}" method="POST">
					@csrf
						<input type="hidden" name="id" />
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Name</label>
									<input type="text" name="company_name" id='company_name' placeholder="Enter company name" class="form-control" required />
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Email</label>
									<input type="text" name="email" id="email" placeholder="Enter email address" class="form-control" required />
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Phone</label>
									<input type="text" name="phone" id="phone" placeholder="Enter phone number" class="form-control" required />
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Maain Contact Name</label>
									<input type="text" name="contact_name" id="contact_name" placeholder="Enter contact name" class="form-control" required />
								</div>
							</div>

							<div class="col-md-12 text-right">
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
								<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Update</button>
							</div>
							<br/>
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
					<p><strong>Are you want to sure to remove Affiliate?</strong></p>
				</div>
				<div class="modal-footer">
					<form method="POST" action="{{route('remove-affiliate')}}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="id" />
						<button class="btn btn-success" data-dismiss="modal"><i class="fa fa-close"></i>  Cancel</button>
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
<script src="{{asset('Admi/assets/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('Admi/assets/js/ajax-loading.js')}}" type="text/javascript"></script>
<script src="{{asset('Admi/assets/plugins/alertify/js/alertify.js')}}"></script>

<script>
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });

        var tbl_sub_admin = $('#id-affiliate').DataTable({
		processing: true,
		servrSide: true,
        "searching": true,
            language: {
            search: "_INPUT_",
                searchPlaceholder: "Search Affiliate"
            },
			ajax:{
				url: "{{ route('get-affiliate') }}",
			},
			columns:[
			{
				data:'created_at',
			},
			{
				data:'company_name',
			},
			{
				data:'phone',
			},
			{
				data:'email',
			},
			{
				data:'main_contact_name',
			},
			{
				data:'link',
			},
			{
				data: null,
				render: function(data, type, full, meta){
					var button = "";
					button = '<button type="button" name="edit" data-id="'+ data.id +'" class="edit btn btn-dark btn-sm" data-toggle="modal" data-target="#updateModal"><i class="fa fa-pencil"></i> Edit</button><br />';
					button += '<button type="button" name="delete" data-id="'+ data.id +'" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i>  Delete</button><br />';

				   return button;
				},
				orderable: false
			}
			]
		});

        $('#add-new-affiliate').on('hidden.bs.collapse', function () {
            // show the button
            $("a[href='#add-new-affiliate']").removeClass("hide");
        });

        $('#add-new-affiliate').on('shown.bs.collapse', function () {
            // hide the button
            $("a[href='#add-new-affiliate']").addClass("hide");
        });

        $(document).on('shown.bs.modal', '#resetpasswordModal', function (e) {
           var id = $(e.relatedTarget).attr('data-id');
            $("#resetpasswordModal input[name='id']").val(id);
        });

        $(document).on('shown.bs.modal', '#confirmModal', function (e) {
			var id = $(e.relatedTarget).attr('data-id');
			$("#confirmModal input[name='id']").val(id);
		});

		$(document).on('shown.bs.modal', '#updateModal', function (e) {
			var id = $(e.relatedTarget).attr('data-id');
            $.ajax({
				url :"{{ route('/') }}/admin/get-specific-affiliate/"+id,
				dataType:"json",
                beforeSend: function() {
                    $("#loader").css("display", "block");
				},
				success:function(data){

                    $('#company_name').val(data.result.company_name);
					$('#phone').val(data.result.phone);
					$('#email').val(data.result.email);
					$('#contact_name').val(data.result.main_contact_name);

					$("#updateModal input[name='id']").val(id);

                    $("#loader").css("display", "none");
				}
			});
        });

	});
</script>

@endsection



