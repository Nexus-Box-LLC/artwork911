@extends('admin.layouts.master')
@section('title', 'Manage Sub Admin')

@section('css')
<link href="{{asset('Admi/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('Admi/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
<style>
	.hide{
		display:none;
	}
</style>
@endsection

@php
	$roles = App\Models\Admin\Role::select("*")->where('show_in_permission',1)->get();
@endphp

@section('breadcrumb-title')
Manage Sub Admin
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Manage Sub Admin</li>
@endsection

@section('content')
	<div class="row">
        @include('admin.auth.flash-message')
		<div class="col-lg-12 col-md-12">
            <div class="card m-b-30">
				<div class="collapse m-b-20" id="add-new-vendor">
					<div class="card-body">
						<h4 class="header-title mt-0 mb-0">Add Sub Admin</h4>
					</div>
					<div class="card-body card-colored">
						<form method="POST" action="{{route('add-sub-admin')}}">
						@csrf
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Company Name</label>
										<input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Enter company name" class="form-control" required />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="username" value="{{ old('username') }}" placeholder="Enter username" class="form-control" required />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Email Address</label>
										<input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" class="form-control" required />
									</div>
								</div>
							   <div class="col-md-3">
									<div class="form-group">
										<label>Select role</label>
										<select name="role" class="form-control" required >
											<option value="">Select role</option>
												@foreach ($roles as $role)
													<option value="{{$role->id}}">{{$role->name}}</option>
												@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 password_field">
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" placeholder="Enter password" class="form-control" />
									</div>
								</div>
								
								<div class="col-md-3 checkbox_field">
									<div class="custom-control custom-checkbox mt-3">
										<input type="checkbox" name="auto_generate_password" class="custom-control-input" id="customCheck1" value="1" required /> 
										<label class="custom-control-label" for="customCheck1">Sub Admin auto generated password </label>
									</div>
								</div>
							</div>
							<div class="row mt-3">	
								<div class="col-md-3">
									<button type="button" class="btn btn-danger" href="#add-new-vendor" data-toggle="collapse" aria-expanded="true">
									<i class="fa fa-close"></i> Cancel</button>
									<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>Add New Sub Admin</button>
								</div>
							</div>
						</form>
					</div>
				</div>
                <div class="card-body">
					<h4 class="header-title mt-0 mb-0 pull-left">Sub Admin List</h4>
					<a href="#add-new-vendor" data-toggle="collapse" aria-expanded="false" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add New Sub Admin</a>
				</div>

				<div class="card-body p0">
					<table id="id-sub-admin" style="width:100%" class="table table-bordered">
						<thead>
							<tr>
								<th width="20%">Created Date</th>
								<th width="20%">Company Name</th>
								<th width="20%">User Name</th>
								<th width="20%">Email</th>
								<th width="20%">Action</th>
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
					<h5 class="modal-title">Update Sub Admin</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
                    <div id="loader">
                        @include('admin.layouts.pre-loader')
                    </div>
					<form action="{{route('update-sub-admin')}}" method="POST">
						@csrf
						<input type="hidden" name="id" />
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Company Name</label>
									<input type="text" name="company_name" id="company_name" placeholder="Enter company name" class="form-control" required />
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" id="username" placeholder="Enter username" class="form-control" required />
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Email Address</label>
									<input type="email" name="email" id="email" placeholder="Enter email address" class="form-control" required />
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Select role</label>
									<select name="role" class="form-control" required />
										<option value="">Select role</option>
										@foreach($roles as $role)
											<option value="{{ $role->id }}">{{ $role->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-12 text-right mt-3">
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
					<strong>Are you sure to delete sub admin?</strong>
				</div>
				<div class="modal-footer">
					<form action="{{route('remove-sub-admin')}}" method="POST">
						@csrf
						<input type="hidden" name="id" />
						<button class="btn btn-success" data-dismiss="modal"><i class="fa fa-close"></i>  Cancel</button>
						<button class="btn btn-danger" type="submit"><i class="fa fa-check"></i> Yes</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade show" style="overflow: auto;display: none;background: opacity: 0.5;" id="resetpasswordModal" data-keyboard="false" data-backdrop="static"  tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="background: #;min-height: 200px;border-radius: 15px;">
				<div class="modal-header">
					<h5 class="modal-title">Change Password</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					<form action="{{route('reset-password')}}" method="POST">
						@csrf
						<input type="hidden" name="id" />
						<div class="row">
							<div class="col-md-12 password_field_pop">
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password_pop" placeholder="Enter password" class="form-control" />
								</div>
							</div>
							<div class="col-md-12 checkbox_field_pop">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="auto_generate_password_pop" class="custom-control-input" id="customCheck" value="1" /> 
									<label class="custom-control-label" for="customCheck">Sub admin auto generated password *</label>
								</div>
							</div>
							<div class="col-md-12 text-right mt-3">
								<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
								<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save</button>
							</div>
						</div>
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

        var tbl_sub_admin = $('#id-sub-admin').DataTable({
		processing: true,
		servrSide: true,
        "searching": true,
            language: {
            search: "_INPUT_",
                searchPlaceholder: "Search sub admin"
            },
			ajax:{
				url: "{{ route('manage-sub-admin') }}",
			},
			columns:[
			{
				data:'created_at',
			},
			{
				data:'company_name',
			},
			{
				data:'username',
			},
			{
				data:'email',
			},
			{
				data: null,
				render: function(data, type, full, meta){
					var button = "";
					button = '<button type="button" name="edit" data-id="'+ data.id +'" class="edit btn btn-dark btn-sm" data-toggle="modal" data-target="#updateModal"><i class="fa fa-pencil"></i> Edit</button><br />';
					button += '<button type="button" name="delete" data-id="'+ data.id +'" class="delete btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-trash"></i>  Delete</button><br />';
                    button +='<button type="button" data-id="'+ data.id +'" class="btn btn-dark waves-effect waves-light btn-sm" data-toggle="modal" data-target="#resetpasswordModal"><i class="mdi mdi-lock"></i> Reset Password</button><br />';

                    if(data.status==1){
                        button += '<button type="button" data-id="'+ data.id +'" data-type="0" class="statusbtn btn btn-primary btn-sm"><i class="fa fa-check"></i> Activate<span class="badge"></span></button>';
                    }else{
                        button += '<button type="button" data-id="'+ data.id +'" data-type="1" class="statusbtn btn btn-danger btn-sm"><i class="fa fa-close"></i> Suspend<span class="badge"></span></button>';
                    }
                    return button;
				},
				orderable: false
			}
			]
		});

        $(document).on('click', '.statusbtn', function(){

            var type = $(this).attr("data-type");

            if(confirm("Are you sure do you want to "+ (type==0 ? "Suspended" : "Activate")  +"?")){

                var id = $(this).attr("data-id");

                var formData = new FormData();
                formData.append("id", id);

                $.ajax({
                    type: "POST",
                    url: "{{route('sub-admin-status')}}",
                    data: formData,
                    cache: false,
                    contentType: false,

                    processData: false,
                    success: function (data){
                        var type = "";

                        alertify.logPosition("top right");

                        if(data.status=="RC200"){
                            alertify.success( data.message );
                            tbl_sub_admin.ajax.reload();
                        }else{
                            type = "danger";
                            alertify.error( data.message );
                        }
                    }
                });

            }
        });

        $('#add-new-vendor').on('hidden.bs.collapse', function () {
            // show the button
            $("a[href='#add-new-vendor']").removeClass("hide");
        });

        $('#add-new-vendor').on('shown.bs.collapse', function () {
            // hide the button
            $("a[href='#add-new-vendor']").addClass("hide");
        });

		$(document).on('shown.bs.modal', '#resetpasswordModal', function (e) {
			var id = $(e.relatedTarget).attr('data-id');
            $("#resetpasswordModal input[name='id']").val(id);
        });
		
        $(document).on('click','input[name="auto_generate_password_pop"]',function(){

            var isChecked = $('input[name="auto_generate_password_pop"]').prop('checked');

            if(isChecked==true)
            {
                $(".password_field_pop").addClass("hide");
                $("input[name='password_pop']").attr("required", false);
                $("input[name='password_pop']").attr("disabled", true);
            }else{
                $(".password_field_pop").removeClass("hide");
                $("input[name='password_pop']").attr( "required", true );
                $("input[name='password_pop']").attr("disabled", false);
            }

        });
		
		$("input[name='password_pop']").on('input',function(e){

			var txtlen = $(this).val().length;

			if(txtlen==0)
			{
				$(".checkbox_field_pop").css("display", "block");
				$("input[name='auto_generate_password_pop']").attr("required", true);

			}else{
				$(".checkbox_field_pop").css("display", "none");
				$("input[name='auto_generate_password_pop']").attr("required", false);
			}

		});
		
        $('input[name="auto_generate_password"]').change(function() {

            var isChecked = $('input[name="auto_generate_password"]').prop('checked');

            if(isChecked==true)
            {
                $(".password_field").css("display", "none");
                $("input[name='password']").attr("required", false);
                $("input[name='password']").attr("disabled", true);
            }else{
                $(".password_field").css("display", "block");
                $('input[name="password]').attr( "required", true );
                $("input[name='password']").attr("disabled", false);
            }

        });
		
		$("input[name='password']").on('input',function(e){

			var txtlen = $(this).val().length;

			if(txtlen==0)
			{
				$(".checkbox_field").css("display", "block");
				$("input[name='auto_generate_password']").attr("required", true);

			}else{
				$(".checkbox_field").css("display", "none");
				$("input[name='auto_generate_password']").attr("required", false);
			}

		});


		$(document).on('shown.bs.modal', '#confirmModal', function (e) {
			var id = $(e.relatedTarget).attr('data-id');
			$("#confirmModal input[name='id']").val(id);
		});

		$(document).on('shown.bs.modal', '#updateModal', function (e) {
			var id = $(e.relatedTarget).attr('data-id');
            $.ajax({
				url :"{{ route('/') }}/admin/get-specific-vendor/"+id,
				dataType:"json",
                beforeSend: function() {
                    $("#loader").css("display", "block");
				},
				success:function(data){
					
					$('#company_name').val(data.result.company_name);
					$('#username').val(data.result.username);
					$('#email').val(data.result.email);

                    $("select[name='role']").val(data.result.role_id).change();

					$("#updateModal input[name='id']").val(id);

                    $("#loader").css("display", "none");
				}
			});
        });

	});
</script>

@endsection
